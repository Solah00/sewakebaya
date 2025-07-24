@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pembayaran</h1>

    <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="penyewaan_id" class="form-label">Pilih Penyewaan</label>
            <select name="penyewaan_id" id="penyewaan_id" class="form-select" required>
                <option value="">-- Pilih Penyewaan --</option>
                @foreach ($penyewaan as $item)
                    <option value="{{ $item->id }}" {{ $pembayaran->penyewaan_id == $item->id ? 'selected' : '' }}>
                        {{ $item->kode_sewa }} - {{ $item->tanggal_sewa }}
                    </option>
                @endforeach
            </select>
            @error('penyewaan_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" value="{{ old('tanggal_bayar', $pembayaran->tanggal_bayar) }}" required>
            @error('tanggal_bayar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jumlah_bayar" class="form-label">Jumlah Bayar (Rp)</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control" value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" min="0" required>
            @error('jumlah_bayar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
