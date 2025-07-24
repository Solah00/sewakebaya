<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = 'penyewaan';

    protected $fillable = [
        'kode_sewa',
        'pelanggan_id',
        'kebaya_id',
        'tanggal_sewa',
        'total_bayar',
    ];

    // Relasi ke pelanggan (asumsi ada model Pelanggan)
    public function kebaya()
{
    return $this->belongsTo(\App\Models\Kebaya::class, 'kebaya_id');
}

    public function pelanggan()
    {
    return $this->belongsTo(Pelanggan::class);
    }
    public function kebayas()
{
    return $this->belongsTo(Kebaya::class, 'kebaya_id');
}
public function details()
    {
        return $this->hasMany(PenyewaanDetail::class);
    }

    // Jika ingin relasi ke kebaya dan kebaya ada di tabel lain, 
    // biasanya butuh tabel pivot atau tabel detail penyewaan.
    // Jadi di model ini tidak ada relasi kebaya langsung.
}
