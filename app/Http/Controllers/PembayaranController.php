<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        // Tampilkan semua pembayaran beserta data penyewaannya
        $pembayaran = Pembayaran::with('penyewaan')->latest()->paginate(10);
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        // Ambil data penyewaan untuk dropdown pilih penyewaan
        $penyewaan = Penyewaan::latest()->get();
        return view('admin.pembayaran.create', compact('penyewaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyewaan_id' => 'required|exists:penyewaan,id',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $penyewaan = Penyewaan::latest()->get();
        return view('admin.pembayaran.edit', compact('pembayaran', 'penyewaan'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'penyewaan_id' => 'required|exists:penyewaan,id',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
