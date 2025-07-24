<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga_sewa',
        'foto',
        // tambahkan kolom lain sesuai migration
    ];
    public function ulasan()
{
    return $this->hasMany(Ulasan::class);
}

}
