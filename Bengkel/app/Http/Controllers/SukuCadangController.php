<?php

namespace App\Http\Controllers;

use App\Models\SukuCadang;
use Illuminate\Http\Request;

class SukuCadangController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari form pencarian
        $search = $request->input('search');

        // Cek kalau ada pencarian
        if ($search) {
            // Filter data pelanggan yang sesuai dengan keyword
            $sukuCadang = SukuCadang::where('nama', 'like', '%' . $search . '%')
                ->orWhere('kode', 'like', '%' . $search . '%')
                ->orWhere('stok', 'like', '%' . $search . '%')
                ->orWhere('harga', 'like', '%' . $search . '%')
                ->get();
        }else{
            // Kalau tidak ada pencarian, tampilkan semua
            $sukuCadang = SukuCadang::all();
        }

        return view('sukuCadang.index')->with('sukuCadang',$sukuCadang);
    }

    public function create()
    {
        return view('sukuCadang.create');
    }

    public function store(Request $request)
    {
        $val = $request -> validate([
            'kode'      => 'required|max:5',
            'nama'      => 'required|max:35',
            'harga'     => 'required',
            'stok'      => 'required|min:0'
        ]);

        SukuCadang::create($val);
        return redirect()->route('sukuCadang.index')->with('success',' Data '. $val['nama'].' berhasil ditambah ');
    }

    public function show(SukuCadang $sukuCadang)
    {
        //
    }

    public function edit(SukuCadang $sukuCadang)
    {
        return view('sukuCadang.edit')->with('sukuCadang', $sukuCadang);
    }

    public function update(Request $request, SukuCadang $sukuCadang)
    {
        $val = $request -> validate([
            'kode'      => 'required|max:5',
            'nama'      => 'required|max:35',
            'harga'     => 'required',
            'stok'      => 'required|min:0'
        ]);

        $sukuCadang -> update($val);
        return redirect()->route('sukuCadang.index')->with('success',' Data '. $val['nama'].' berhasil diperbarui ');
    }

    public function destroy(SukuCadang $sukuCadang)
    {
        //
    }
}
