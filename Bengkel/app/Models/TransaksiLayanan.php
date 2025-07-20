<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiLayanan extends Model
{
    protected $fillable = ['transaksi_bengkel_id', 'layanan_id', 'jumlah', 'subtotal'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
