<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\SukuCadang;
use App\Models\TransaksiBengkel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiBengkelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil user login
        $user = Auth::user();

        $query = TransaksiBengkel::with('layanan', 'sukuCadangs');

        // Kalau bukan admin, batasi ke user_id
        if ($user->role !== 'A') {
            $query->where('user_id', $user->id);
        }

        // Tambahkan fitur pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhereHas('layanan', fn($q2) => $q2->where('nama_layanan', 'like', "%$search%"))
                ->orWhereHas('sukuCadangs', fn($q3) => $q3->where('nama', 'like', "%$search%"));
            });
        }

        $transaksi = $query->paginate(10);

        return view('transaksiBengkel.index', compact('transaksi'));
    }

    public function create(Request $request)
    {
        $sukuCadangs = SukuCadang::all();
        $layanan = Layanan::all();
        $selectedLayanan = $request->get('layanan_id');

        return view('transaksiBengkel.create', compact('sukuCadangs', 'layanan','selectedLayanan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'layanan_id' => 'required|exists:layanans,id',
            'sukuCadangs' => 'nullable|array',
            'sukuCadangs.*.selected' => 'nullable|in:1',
            'sukuCadangs.*.id' => 'required_with:sukuCadangs.*.selected|exists:suku_cadangs,id',
            'sukuCadangs.*.jumlah' => 'required_with:sukuCadangs.*.selected|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $layanan = Layanan::findOrFail($validated['layanan_id']);
            $totalBiaya = $layanan->biaya;

            $transaksi = TransaksiBengkel::create([
                'nama' => $validated['nama'],
                'layanan_id' => $validated['layanan_id'],
                'total_biaya' => 0,
                'user_id' => Auth::id(),
            ]);

            $stokKurang = [];

            if (!empty($validated['sukuCadangs'])) {
                foreach ($validated['sukuCadangs'] as $sc) {
                    if (isset($sc['selected'])) {
                        $sukuCadang = SukuCadang::findOrFail($sc['id']);
                        $jumlah = $sc['jumlah'];

                        if ($sukuCadang->stok < $jumlah) {
                            $stokKurang[] = "{$sukuCadang->nama} | Sisa Stok: {$sukuCadang->stok}";
                        }
                    }
                }
            }

            if (!empty($stokKurang)) {
                DB::rollBack();

                $pesan = "Beberapa suku cadang tidak mencukupi stok:<br><ul>";
                foreach ($stokKurang as $item) {
                    $pesan .= "<li>{$item}</li>";
                }
                $pesan .= "</ul>";

                return redirect()->back()
                    ->with('warning_html', $pesan)
                    ->withInput();
            }

            if (!empty($validated['sukuCadangs'])) {
                foreach ($validated['sukuCadangs'] as $sc) {
                    if (isset($sc['selected'])) {
                        $sukuCadang = SukuCadang::findOrFail($sc['id']);
                        $jumlah = $sc['jumlah'];
                        $subtotal = $sukuCadang->harga * $jumlah;

                        $transaksi->sukuCadangs()->attach($sukuCadang->id, [
                            'jumlah' => $jumlah,
                            'subtotal' => $subtotal,
                        ]);

                        $sukuCadang->decrement('stok', $jumlah);
                        $totalBiaya += $subtotal;
                    }
                }
            }

            $transaksi->update(['total_biaya' => $totalBiaya]);

            DB::commit();

            return redirect()->route('transaksiBengkel.index')
                ->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menyimpan transaksi: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $transaksi = TransaksiBengkel::with('layanan', 'sukuCadangs')->findOrFail($id);
        return view('transaksiBengkel.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = TransaksiBengkel::with('sukuCadangs')->findOrFail($id);
        $sukuCadangs = SukuCadang::all();
        $layanan = Layanan::all();

        return view('transaksiBengkel.edit', compact('transaksi', 'sukuCadangs', 'layanan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'layanan_id' => 'required|exists:layanans,id',
            'sukuCadangs' => 'nullable|array',
            'sukuCadangs.*.id' => 'required_with:sukuCadangs|exists:suku_cadangs,id',
            'sukuCadangs.*.jumlah' => 'required_with:sukuCadangs|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $layanan = Layanan::findOrFail($validated['layanan_id']);
            $totalBiaya = $layanan->biaya;

            $transaksi = TransaksiBengkel::findOrFail($id);

            // Pulihkan stok sebelum update
            foreach ($transaksi->sukuCadangs as $sc) {
                $sc->increment('stok', $sc->pivot->jumlah);
            }

            $transaksi->sukuCadangs()->detach();

            $transaksi->update([
                'nama' => $validated['nama'],
                'layanan_id' => $validated['layanan_id'],
                'total_biaya' => 0,
            ]);

            if (!empty($validated['sukuCadangs'])) {
                foreach ($validated['sukuCadangs'] as $sc) {
                    $sukuCadang = SukuCadang::findOrFail($sc['id']);
                    $jumlah = $sc['jumlah'];
                    $subtotal = $sukuCadang->harga * $jumlah;

                    $transaksi->sukuCadangs()->attach($sukuCadang->id, [
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal,
                    ]);

                    $sukuCadang->decrement('stok', $jumlah);
                    $totalBiaya += $subtotal;
                }
            }

            $transaksi->update(['total_biaya' => $totalBiaya]);

            DB::commit();

            return redirect()->route('transaksiBengkel.index')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal memperbarui transaksi: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(TransaksiBengkel $transaksiBengkel)
    {
        DB::beginTransaction();

        try {
            foreach ($transaksiBengkel->sukuCadangs as $sc) {
                $sc->increment('stok', $sc->pivot->jumlah);
            }

            $transaksiBengkel->delete();

            DB::commit();

            return redirect()->route('transaksiBengkel.index')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}
