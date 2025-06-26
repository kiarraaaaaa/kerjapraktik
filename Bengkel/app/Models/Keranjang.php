<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs';

    protected $fillable = [
        'user_id',
        'suku_cadang_id',
        'jumlah',
    ];

    /**
     * Relasi ke user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke suku cadang.
     */
    public function sukuCadang()
    {
        return $this->belongsTo(SukuCadang::class, 'suku_cadang_id');
    }
}
