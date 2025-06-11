<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('nohp', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('kendaraan', 'like', '%' . $search . '%')
                ->get();
        } else {
            $users = User::all();
        }

        return view('pelanggan.index')->with('pelanggan', $users);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit(User $pelanggan)
    {
        return view('pelanggan.edit')->with('pelanggan', $pelanggan);
    }

    public function update(Request $request, User $pelanggan)
    {
        $val = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $pelanggan->id,
            'nohp' => 'required|max:13',
            'alamat' => 'required|max:100',
            'kendaraan' => 'required|max:50',
        ]);

        $pelanggan->update($val);
        return redirect()->route('pelanggan.index')->with('success', 'Data ' . $val['name'] . ' berhasil diperbarui');
    }

    public function destroy(User $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}
