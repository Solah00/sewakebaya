<?php

namespace App\Http\Controllers;

use App\Models\Kebaya;

class KatalogController extends Controller
{
    public function index()
    {
        $kebayas = Kebaya::with('ulasan')->paginate(6); // angka 6 bisa disesuaikan

        return view('katalog', compact('kebayas'));
    }
}
