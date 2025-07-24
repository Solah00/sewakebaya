<?php

namespace App\Http\Controllers;

use App\Models\Kebaya;
use App\Models\Penyewaan;

class HomeController extends Controller
{
    public function index()
    {
        $kebayas = Kebaya::with('ulasan')->get();

        // Ambil kebaya favorit berdasarkan total qty penyewaan terbanyak
        $kebayaFavorit = Penyewaan::select('kebaya_id')
            ->selectRaw('SUM(qty) as total_qty')
            ->groupBy('kebaya_id')
            ->orderByDesc('total_qty')
            ->with('kebaya') // pastikan relasi 'kebaya' ada di model Penyewaan
            ->take(5)
            ->get();

        return view('welcome', compact('kebayas', 'kebayaFavorit'));
    }
}
