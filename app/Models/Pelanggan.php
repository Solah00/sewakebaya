<?php

// app/Models/Pelanggan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = ['nama', 'email'];
}
