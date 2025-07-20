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

        $query = TransaksiBengkel::with('layanans', 'sukuCadangs');

        // Kalau bukan admin, batasi ke user_id
        if ($user->role !== 'A') {
            $query->where('user_id', $user->id);
        }

        // Tambahkan fitur pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhereHas('layanans', fn($q2) => $q2->where('nama_layanan', 'like', "%$search%"))
                    ->orWhereHas('sukuCadangs', fn($q3) => $q3->where('nama', 'like', "%$search%"));
            });
        }

        $transaksi = $query->paginate(100);

        return view('transaksiBengkel.index', compact('transaksi'));
    }

    // public function create(Request $request)
    // {
    //     $sukuCadangs = SukuCadang::all();
    //     $layanan = Layanan::all();
    //     $selectedLayanan = $request->get('layanan_id');

    //     // Ambil data suku cadang terpilih dari request
    //     $selectedSukuCadangs = [];

    //     if ($request->has('sukuCadangs')) {
    //         foreach ($request->input('sukuCadangs') as $sc) {
    //             if (isset($sc['id'])) {
    //                 $selectedSukuCadangs[] = [
    //                     'id' => $sc['id'],
    //                     'jumlah' => $sc['jumlah'] ?? 1,
    //                 ];
    //             }
    //         }
    //     }

    //     return view('transaksiBengkel.create', compact(
    //         'sukuCadangs',
    //         'layanan',
    //         'selectedLayanan',
    //         'selectedSukuCadangs'
    //     ));
    // }

    public function create(Request $request)
    {
        $sukuCadangs = SukuCadang::all();
        $layanan = Layanan::all();

        $selectedLayanans = [];

        // Tambah dari ?layanan_id (misalnya dari tombol cepat)
        if ($request->has('layanan_id')) {
            $selectedLayanans[] = [
                'id' => $request->get('layanan_id'),
                'jumlah' => 1,
            ];
        }

        // Tambah dari form lama (jika validasi gagal)
        if ($request->has('layanans')) {
            foreach ($request->input('layanans') as $layananInput) {
                if (isset($layananInput['id'])) {
                    $selectedLayanans[] = [
                        'id' => $layananInput['id'],
                        'jumlah' => $layananInput['jumlah'] ?? 1,
                    ];
                }
            }
        }

        $selectedSukuCadangs = [];
        if ($request->has('sukuCadangs')) {
            foreach ($request->input('sukuCadangs') as $sc) {
                if (isset($sc['id'])) {
                    $selectedSukuCadangs[] = [
                        'id' => $sc['id'],
                        'jumlah' => $sc['jumlah'] ?? 1,
                    ];
                }
            }
        }

        return view('transaksiBengkel.create', compact(
            'sukuCadangs',
            'layanan',
            'selectedLayanans',
            'selectedSukuCadangs'
        ));
    }



    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:100',
    //         'alamat' => 'required|string|max:100',
    //         'layanan_id' => 'nullable|exists:layanans,id',
    //         'sukuCadangs' => 'nullable|array',
    //         'sukuCadangs.*.id' => 'required|distinct|exists:suku_cadangs,id',
    //         'sukuCadangs.*.jumlah' => 'required|integer|min:1',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $totalBiaya = 0;

    //         // Ambil data layanan jika ada
    //         $layanan = null;
    //         if (!empty($validated['layanan_id'])) {
    //             $layanan = Layanan::findOrFail($validated['layanan_id']);
    //             $totalBiaya += $layanan->biaya;
    //         }

    //         // Buat transaksi (total biaya nanti diupdate)
    //         $transaksi = TransaksiBengkel::create([
    //             'nama' => $validated['nama'],
    //             'alamat' => $validated['alamat'],
    //             'layanan_id' => $layanan?->id,
    //             'total_biaya' => 0,
    //             'user_id' => Auth::id(),
    //         ]);

    //         $stokKurang = [];
    //         $sukuCadangMap = [];

    //         // Cek stok jika suku cadang ada
    //         if (!empty($validated['sukuCadangs'])) {
    //             foreach ($validated['sukuCadangs'] as $sc) {
    //                 $sukuCadang = SukuCadang::findOrFail($sc['id']);
    //                 $jumlah = $sc['jumlah'];

    //                 if ($sukuCadang->stok < $jumlah) {
    //                     $stokKurang[] = "{$sukuCadang->nama} (Stok: {$sukuCadang->stok})";
    //                 } else {
    //                     $sukuCadangMap[] = [
    //                         'model' => $sukuCadang,
    //                         'jumlah' => $jumlah,
    //                     ];
    //                 }
    //             }
    //         }

    //         // Jika stok tidak cukup, rollback dan tampilkan error
    //         if (!empty($stokKurang)) {
    //             DB::rollBack();

    //             $pesan = "Beberapa suku cadang tidak mencukupi stok:<br><ul>";
    //             foreach ($stokKurang as $item) {
    //                 $pesan .= "<li>{$item}</li>";
    //             }
    //             $pesan .= "</ul>";

    //             return redirect()->back()
    //                 ->with('warning_html', $pesan)
    //                 ->withInput();
    //         }

    //         // Simpan suku cadang jika stok aman
    //         foreach ($sukuCadangMap as $item) {
    //             $sc = $item['model'];
    //             $jumlah = $item['jumlah'];
    //             $subtotal = $sc->harga * $jumlah;

    //             $transaksi->sukuCadangs()->attach($sc->id, [
    //                 'jumlah' => $jumlah,
    //                 'subtotal' => $subtotal,
    //             ]);

    //             $sc->decrement('stok', $jumlah);
    //             $totalBiaya += $subtotal;
    //         }

    //         // Update total biaya transaksi
    //         $transaksi->update(['total_biaya' => $totalBiaya]);

    //         DB::commit();

    //         return redirect()->route('transaksiBengkel.index')
    //             ->with('success', 'Transaksi berhasil disimpan.');
    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         report($e);
    //         return back()->withErrors('Gagal menyimpan transaksi: ' . $e->getMessage())->withInput();
    //     }
    // }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nohp' => 'required|string|max:100',
            'alamat' => 'required|string|max:100',
            'layanans' => 'nullable|array',
            'layanans.*.id' => 'required|distinct|exists:layanans,id',
            'layanans.*.jumlah' => 'required|integer|min:1',
            'sukuCadangs' => 'nullable|array',
            'sukuCadangs.*.id' => 'required|distinct|exists:suku_cadangs,id',
            'sukuCadangs.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $totalBiaya = 0;

            // Buat transaksi awal tanpa total biaya
            $transaksi = TransaksiBengkel::create([
                'nohp' => $validated['nohp'],
                'alamat' => $validated['alamat'],
                'status' => 'pending', // Atur status awal
                'total_biaya' => 0,
                'user_id' => Auth::id(),
            ]);

            // Proses layanan jika ada
            if (!empty($validated['layanans'])) {
                foreach ($validated['layanans'] as $layananData) {
                    $layanan = Layanan::findOrFail($layananData['id']);
                    $jumlah = $layananData['jumlah'];
                    $subtotal = $layanan->biaya * $jumlah;

                    $transaksi->layanans()->attach($layanan->id, [
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal,
                    ]);

                    $totalBiaya += $subtotal;
                }
            }

            // Proses suku cadang
            $stokKurang = [];
            $sukuCadangMap = [];

            if (!empty($validated['sukuCadangs'])) {
                foreach ($validated['sukuCadangs'] as $sc) {
                    $sukuCadang = SukuCadang::findOrFail($sc['id']);
                    $jumlah = $sc['jumlah'];

                    if ($sukuCadang->stok < $jumlah) {
                        $stokKurang[] = "{$sukuCadang->nama} (Stok: {$sukuCadang->stok})";
                    } else {
                        $sukuCadangMap[] = [
                            'model' => $sukuCadang,
                            'jumlah' => $jumlah,
                        ];
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

                foreach ($sukuCadangMap as $item) {
                    $sc = $item['model'];
                    $jumlah = $item['jumlah'];
                    $subtotal = $sc->harga * $jumlah;

                    $transaksi->sukuCadangs()->attach($sc->id, [
                        'jumlah' => $jumlah,
                        'subtotal' => $subtotal,
                    ]);

                    $sc->decrement('stok', $jumlah);
                    $totalBiaya += $subtotal;
                }
            }

            // Update total biaya akhir
            $transaksi->update(['total_biaya' => $totalBiaya]);

            DB::commit();

            return redirect()->route('transaksiBengkel.index')
                ->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withErrors('Gagal menyimpan transaksi: ' . $e->getMessage())->withInput();
        }
    }



    public function show($id)
    {
        $transaksi = TransaksiBengkel::with('layanans', 'sukuCadangs')->findOrFail($id);
        return view('transaksiBengkel.show', compact('transaksi'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(TransaksiBengkel $transaksiBengkel)
    {
        //
    }
}
