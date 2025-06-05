<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSukuCadang extends Model
{
    protected $fillable = ['transaksi_bengkel_id', 'suku_cadang_id', 'jumlah', 'subtotal'];

    public function sukuCadang()
    {
        return $this->belongsTo(SukuCadang::class);
    }
}
