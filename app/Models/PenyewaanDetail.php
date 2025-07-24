<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanDetail extends Model
{
    protected $fillable = ['penyewaan_id', 'kebaya_id', 'qty', 'harga_satuan', 'subtotal'];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }

    public function kebaya()
    {
        return $this->belongsTo(Kebaya::class);
    }
}
