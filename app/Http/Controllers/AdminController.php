<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kebaya;

class AdminController extends Controller
{
    // Menampilkan semua kebaya di halaman admin
    public function index()
    {
        $kebayas = Kebaya::all();  // Mengambil semua data kebaya
        return view('admin.index', compact('kebayas'));
    }

    // Menampilkan form untuk menambah kebaya baru
    public function create()
    {
        return view('admin.create');
    }

    // Menyimpan kebaya baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kebaya' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kebaya = new Kebaya();
        $kebaya->nama_kebaya = $request->nama_kebaya;
        $kebaya->harga_sewa = $request->harga_sewa;
        $kebaya->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $kebaya->gambar = $request->file('gambar')->store('images', 'public');
        }

        $kebaya->save();

        return redirect()->route('admin.dashboard.index')->with('success', 'Kebaya berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit kebaya
    public function edit($id)
    {
        $kebaya = Kebaya::findOrFail($id);
        return view('admin.edit', compact('kebaya'));
    }

    // Mengupdate data kebaya
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kebaya' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kebaya = Kebaya::findOrFail($id);
        $kebaya->nama_kebaya = $request->nama_kebaya;
        $kebaya->harga_sewa = $request->harga_sewa;
        $kebaya->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            // Menghapus gambar lama jika ada
            if ($kebaya->gambar) {
                Storage::delete('public/' . $kebaya->gambar);
            }
            $kebaya->gambar = $request->file('gambar')->store('images', 'public');
        }

        $kebaya->save();

        return redirect()->route('admin.dashboard.index')->with('success', 'Kebaya berhasil diperbarui!');
    }

    // Menghapus kebaya
    public function destroy($id)
    {
        $kebaya = Kebaya::findOrFail($id);
        // Menghapus gambar kebaya jika ada
        if ($kebaya->gambar) {
            Storage::delete('public/' . $kebaya->gambar);
        }
        $kebaya->delete();

        return redirect()->route('admin.dashboard.index')->with('success', 'Kebaya berhasil dihapus!');
    }
}
