<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'penyewaan_id',
        'tanggal_bayar',
        'jumlah_bayar',
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
