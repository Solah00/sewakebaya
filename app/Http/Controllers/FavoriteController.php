<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;

class FavoriteController extends Controller
{
    public function index()
    {
        $kebayaFavorit = Penyewaan::select('kebaya_id')
            ->selectRaw('SUM(qty) as total_qty')
            ->groupBy('kebaya_id')
            ->orderByDesc('total_qty')
            ->with('kebaya')
            ->take(10)
            ->get();

        return view('favorite', compact('kebayaFavorit'));
    }
}
