<?php

namespace App\Http\Controllers;

use App\Models\Kebaya;
use Illuminate\Http\Request;

class KebayaController extends Controller
{
    public function index()
    {
        $kebayas = Kebaya::all();
        return view('admin.kebayas.index', compact('kebayas'));
    }

    public function create()
    {
        return view('admin.kebayas.create');
    }

public function store(Request $request)
{
    // Validasi
    $request->validate([
        'nama' => 'required',
        'harga_sewa' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Buat instance kebaya
    $kebaya = new Kebaya();
    $kebaya->nama = $request->nama;
    $kebaya->harga_sewa = $request->harga_sewa;

    // Simpan gambar jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename); // simpan ke folder public/uploads
        $kebaya->gambar = $filename; // simpan nama file ke database
    }

    // Simpan ke database
    $kebaya->save();

    // Redirect dengan pesan sukses
    return redirect()->route('admin.kebayas.index')->with('success', 'Data berhasil ditambahkan.');
}



    public function show(Kebaya $kebaya)
    {
        return view('admin.kebayas.show', compact('kebaya'));
    }

    public function edit(Kebaya $kebaya)
    {
        return view('admin.kebayas.edit', compact('kebaya'));
    }

 public function update(Request $request, Kebaya $kebaya)
{
    $request->validate([
        'nama' => 'required',
        'harga_sewa' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $data['foto'] = 'uploads/' . $filename;
    }

    $kebaya->update($data);

    return redirect()->route('admin.kebayas.index')->with('success', 'Kebaya berhasil diupdate.');
}


    public function destroy(Kebaya $kebaya)
    {
        $kebaya->delete();

        return redirect()->route('admin.kebayas.index')->with('success', 'Kebaya berhasil dihapus.');
    }
    
}
