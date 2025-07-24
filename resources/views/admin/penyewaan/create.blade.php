@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Penyewaan</h2>

    <form action="{{ route('admin.penyewaan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pelanggan</label>
            <select name="pelanggan_id" class="form-select" required>
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tambahan Nama Kebaya --}}
        <div class="mb-3">
            <label for="kebaya_id" class="form-label">Nama Kebaya</label>
            <select name="kebaya_id" class="form-select" required>
                <option value="">Pilih Kebaya</option>
                @foreach($kebayas as $kebaya)
                    <option value="{{ $kebaya->id }}">{{ $kebaya->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
    <label for="qty" class="form-label">Jumlah Kebaya</label>
    <input type="number" name="qty" class="form-control" min="1" value="1" required>
</div>


        <div class="mb-3">
            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
            <input type="date" name="tanggal_sewa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_bayar" class="form-label">Total Bayar</label>
            <input type="number" name="total_bayar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
