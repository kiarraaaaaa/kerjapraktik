<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari form pencarian
        $search = $request->input('search');

        // Cek kalau ada pencarian
        if ($search) {
            // Filter data pelanggan yang sesuai dengan keyword
            $pelanggan = Pelanggan::where('nama', 'like', '%' . $search . '%')
                ->orWhere('nohp', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('kendaraan', 'like', '%' . $search . '%')
                ->get();
        }else{
            // Kalau tidak ada pencarian, tampilkan semua
            $pelanggan = Pelanggan::all();
        }

        return view('pelanggan.index')->with('pelanggan',$pelanggan);
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $val = $request -> validate([
            'nama' => 'required|max:25',
            'nohp' => 'required|max:13',
            'alamat' => 'required|max:40',
            'kendaraan' => 'required|max:30'
        ]);

        Pelanggan::create($val);
        return redirect()->route('pelanggan.index')->with('success',' Data '. $val['nama'].' berhasil ditambah ');
    }

    public function show(Pelanggan $pelanggan)
    {
        //
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit')->with('pelanggan', $pelanggan);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $val = $request -> validate([
            'nama' => 'required|max:25',
            'nohp' => 'required|max:13',
            'alamat' => 'required|max:40',
            'kendaraan' => 'required|max:30'
        ]);

        $pelanggan -> update($val);
        return redirect()->route('pelanggan.index')->with('success',' Data '. $val['nama'].' berhasil diperbarui ');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        //
    }
}
