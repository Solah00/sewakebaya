<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kebaya_id' => 'required|exists:kebayas,id',
            'nama_pengulas' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        Ulasan::create($request->only('kebaya_id', 'nama_pengulas', 'rating', 'komentar'));

        return redirect()->back()->with('success', 'Terima kasih atas ulasannya!');
    }
}
