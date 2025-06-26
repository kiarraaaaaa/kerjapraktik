<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('sukuCadang')
            ->where('user_id', Auth::id())
            ->get();

        return view('keranjang.index', compact('keranjang'));
    }

    /**
     * Tambahkan suku cadang ke keranjang
     */
    public function tambah(Request $request, $sukuCadangId)
    {
        $userId = Auth::id();

        $keranjang = Keranjang::where('user_id', $userId)
            ->where('suku_cadang_id', $sukuCadangId)
            ->first();

        if ($keranjang) {
            $keranjang->jumlah += 1;
            $keranjang->save();
        } else {
            Keranjang::create([
                'user_id' => $userId,
                'suku_cadang_id' => $sukuCadangId,
                'jumlah' => 1
            ]);
        }

        return back()->with('success', 'Barang ditambahkan ke keranjang.');
    }

    /**
     * Update jumlah barang di keranjang
     */
    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Jumlah diperbarui.');
    }

    /**
     * Hapus barang dari keranjang
     */
    public function hapus($id)
    {
        $keranjang = Keranjang::findOrFail($id);

        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $keranjang->delete();

        return back()->with('success', 'Barang dihapus dari keranjang.');
    }
}
