<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = ['kebaya_id', 'nama_pengulas', 'rating', 'komentar'];

    public function kebaya()
    {
        return $this->belongsTo(Kebaya::class);
    }
}

