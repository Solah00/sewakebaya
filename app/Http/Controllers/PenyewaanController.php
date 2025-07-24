<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kebaya;


class PenyewaanController extends Controller
{
    public function index()
    {
        $penyewaans = Penyewaan::with('pelanggan')->latest()->get();
        return view('admin.penyewaan.index', compact('penyewaans'));
        $penyewaans = Penyewaan::with(['pelanggan', 'kebayas'])->paginate(10);
    $penyewaans = Penyewaan::with(['pelanggan', 'kebaya'])->get();
    return view('admin.penyewaan.index', compact('penyewaans'));    

    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
    $pelanggans = Pelanggan::all();
    $kebayas = Kebaya::all(); // Tambahkan ini

    return view('admin.penyewaan.create', compact('pelanggans', 'kebayas'));

    }

    public function store(Request $request)
{
    $request->validate([
        'pelanggan_id' => 'required|exists:pelanggan,id',
        'kebaya_id' => 'required|exists:kebayas,id',
        'tanggal_sewa' => 'required|date',
        'total_bayar' => 'required|numeric',
        'qty' => 'required|integer|min:1',  // Tambahkan validasi qty
    ]);

    Penyewaan::create([
        'kode_sewa' => strtoupper('SEWA-' . Str::random(6)),
        'pelanggan_id' => $request->pelanggan_id,
        'kebaya_id' => $request->kebaya_id,
        'tanggal_sewa' => $request->tanggal_sewa,
        'total_bayar' => $request->total_bayar,
        'qty' => $request->qty,  // Simpan qty
    ]);

    return redirect()->route('admin.penyewaan.index')->with('success', 'Penyewaan berhasil ditambahkan.');
}

    public function edit($id)
{
    $penyewaan = Penyewaan::findOrFail($id);
    $pelanggans = Pelanggan::all(); // Untuk dropdown pelanggan
    return view('admin.penyewaan.edit', compact('penyewaan', 'pelanggans'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'pelanggan_id' => 'required|exists:pelanggan,id',
        'tanggal_sewa' => 'required|date',
        'total_bayar' => 'required|numeric',
    ]);

    $penyewaan = Penyewaan::findOrFail($id);
    $penyewaan->update([
        'pelanggan_id' => $request->pelanggan_id,
        'tanggal_sewa' => $request->tanggal_sewa,
        'total_bayar' => $request->total_bayar,
    ]);

    return redirect()->route('admin.penyewaan.index')->with('success', 'Data penyewaan berhasil diperbarui.');
}
public function destroy($id)
{
    $penyewaan = Penyewaan::findOrFail($id);
    $penyewaan->delete();

    return redirect()->route('admin.penyewaan.index')->with('success', 'Data penyewaan berhasil dihapus.');
}

}
