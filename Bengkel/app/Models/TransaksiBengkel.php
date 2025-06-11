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
        'nama','user_id', 'layanan_id', 'total_biaya'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
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
