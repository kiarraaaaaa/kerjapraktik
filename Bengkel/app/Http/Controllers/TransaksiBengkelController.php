<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\SukuCadang;
use App\Models\TransaksiBengkel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiBengkelController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari form pencarian
        $search = $request->input('search');

        $query = TransaksiBengkel::with('pelanggan', 'layanan', 'sukuCadangs');

        // Jika ada pencarian
        if ($search) {
            $query->whereHas('pelanggan', function($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('layanan', function($q) use ($search) {
                    $q->where('nama_layanan', 'like', '%' . $search . '%');
                })
                ->orWhereHas('sukuCadangs', function($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
        }

        // Eksekusi query
        $transaksi = $query->paginate(10);
        return view('transaksiBengkel.index')->with('transaksi', $transaksi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $sukuCadangs = SukuCadang::all();
        $layanan = Layanan::all();

        return view('transaksiBengkel.create', compact('pelanggan', 'sukuCadangs', 'layanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'layanan_id'   => 'required|exists:layanans,id',
            'sukuCadangs'  => 'nullable|array',
            'sukuCadangs.*.selected' => 'nullable|in:1',
            'sukuCadangs.*.id' => 'required_with:sukuCadangs.*.selected|exists:suku_cadangs,id',
            'sukuCadangs.*.jumlah' => 'required_with:sukuCadangs.*.selected|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Ambil data layanan
            $layanan = Layanan::findOrFail($validated['layanan_id']);
            $totalBiaya = $layanan->biaya;

            // Buat transaksi bengkel
            $transaksi = TransaksiBengkel::create([
                'pelanggan_id' => $validated['pelanggan_id'],
                'layanan_id'   => $validated['layanan_id'],
                'total_biaya'  => 0, // sementara, nanti diupdate
            ]);

            $stokKurang = [];

            // Cek stok dulu kalau ada suku cadang dipilih
            if (!empty($validated['sukuCadangs'])) {
                foreach ($validated['sukuCadangs'] as $sc) {
                    if (isset($sc['selected'])) {
                        $sukuCadang = SukuCadang::findOrFail($sc['id']);
                        $jumlah = $sc['jumlah'];

                        if ($sukuCadang->stok < $jumlah) {
                            $stokKurang[] = "{$sukuCadang->nama} |  Sisa Stok :  {$sukuCadang->stok} |";
                        }
                    }
                }
            }

            // Kalau ada stok kurang, rollback & kirim notif
            if (!empty($stokKurang)) {
                DB::rollBack();

                $pesan = "Beberapa suku cadang tidak mencukupi stoknya :<br><ul>";
                foreach ($stokKurang as $item) {
                    $pesan .= "<li>{$item}</li>";
                }
                $pesan .= "</ul>";

                return redirect()->back()
                    ->with('warning_html', $pesan)
                    ->withInput();
            }

            // Proses insert suku cadang ke pivot & kurangi stok
            if (!empty($validated['sukuCadangs'])) {
                foreach ($validated['sukuCadangs'] as $sc) {
                    if (isset($sc['selected'])) {
                        $sukuCadang = SukuCadang::findOrFail($sc['id']);
                        $jumlah = $sc['jumlah'];
                        $subtotal = $sukuCadang->harga * $jumlah;

                        // Attach ke pivot
                        $transaksi->sukuCadangs()->attach($sukuCadang->id, [
                            'jumlah' => $jumlah,
                            'subtotal' => $subtotal,
                        ]);

                        // Kurangi stok
                        $sukuCadang->decrement('stok', $jumlah);

                        // Tambahkan ke total biaya
                        $totalBiaya += $subtotal;
                    }
                }
            }

            // Update total biaya transaksi
            $transaksi->update(['total_biaya' => $totalBiaya]);

            DB::commit();

            return redirect()->route('transaksiBengkel.index')
                ->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Gagal menyimpan transaksi: ' . $e->getMessage())
                        ->withInput();
        }
    }




    public function show($id)
    {
        $transaksi = TransaksiBengkel::with('pelanggan', 'layanan', 'sukuCadangs')->findOrFail($id);
        return view('transaksiBengkel.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = TransaksiBengkel::with('sukuCadangs')->findOrFail($id);
        $pelanggan = Pelanggan::all();
        $sukuCadangs = SukuCadang::all();
        $layanan = Layanan::all();

        return view('transaksiBengkel.edit', compact('transaksi', 'pelanggan', 'sukuCadangs', 'layanan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'layanan_id'   => 'required|exists:layanans,id',
            'sukuCadangs'  => 'nullable|array',
            'sukuCadangs.*.id' => 'required_with:sukuCadangs|exists:suku_cadangs,id',
            'sukuCadangs.*.jumlah' => 'required_with:sukuCadangs|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $layanan = Layanan::findOrFail($validated['layanan_id']);
            $totalBiaya = $layanan->biaya;

            $transaksi = TransaksiBengkel::findOrFail($id);
            $transaksi->update([
                'pelanggan_id' => $validated['pelanggan_id'],
                'layanan_id'   => $validated['layanan_id'],
                'total_biaya'  => 0, // sementara
            ]);

            // Hapus relasi suku cadang lama
            $transaksi->sukuCadangs()->detach();

            // Tambah ulang relasi suku cadang baru
            if (!empty($validated['sukuCadangs'])) {
                foreach ($validated['sukuCadangs'] as $sc) {
                    $sukuCadang = SukuCadang::findOrFail($sc['id']);
                    $jumlah = $sc['jumlah'];
                    $subtotal = $sukuCadang->harga * $jumlah;

                    $transaksi->sukuCadangs()->attach($sukuCadang->id, [
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal,
                    ]);

                    $totalBiaya += $subtotal;
                }
            }

            $transaksi->update(['total_biaya' => $totalBiaya]);

            DB::commit();

            return redirect()->route('transaksiBengkel.index')->with('success', 'Transaksi berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal update transaksi: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiBengkel $transaksiBengkel)
    {
        //
    }
}
