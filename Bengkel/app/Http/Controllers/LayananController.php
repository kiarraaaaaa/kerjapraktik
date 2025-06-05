<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari form pencarian
        $search = $request->input('search');

        // Cek kalau ada pencarian
        if ($search) {
            // Filter data pelanggan yang sesuai dengan keyword
            $layanan = Layanan::where('nama_layanan', 'like', '%' . $search . '%')
                ->orWhere('biaya', 'like', '%' . $search . '%')
                ->get();
        }else{
            // Kalau tidak ada pencarian, tampilkan semua
            $layanan = Layanan::all();
        }

        return view('layanan.index')->with('layanan',$layanan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request -> validate([
            'nama_layanan'  => 'required|max:30',
            'biaya'         => 'required'
        ]);

        Layanan::create($val);
        return redirect()->route('layanan.index')->with('success',' Data '. $val['nama_layanan'].' berhasil ditambah ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('layanan.edit')->with('layanan', $layanan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        $val = $request -> validate([
            'nama_layanan'  => 'required|max:30',
            'biaya'         => 'required'
        ]);

        $layanan -> update($val);
        return redirect()->route('layanan.index')->with('success',' Data '. $val['nama_layanan'].' berhasil diperbarui ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        //
    }
}
