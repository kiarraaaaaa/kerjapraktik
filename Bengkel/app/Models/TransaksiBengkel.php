<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransaksiBengkel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable =
    [
        'user_id',
        'alamat',
        'nohp',
        'total_biaya',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function layanans()
    {
        return $this->belongsToMany(Layanan::class, 'transaksi_layanans')
            ->withPivot('jumlah', 'subtotal')
            ->withTimestamps();
    }

    public function sukuCadangs()
    {
        return $this->belongsToMany(SukuCadang::class, 'transaksi_suku_cadangs')
            ->withPivot('jumlah', 'subtotal')
            ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}
