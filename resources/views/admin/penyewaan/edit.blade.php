@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Penyewaan</h2>

    <form action="{{ route('admin.penyewaan.update', $penyewaan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Pelanggan</label>
            <select name="pelanggan_id" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ $penyewaan->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
            <input type="date" name="tanggal_sewa" class="form-control" value="{{ $penyewaan->tanggal_sewa }}" required>
        </div>

        <div class="mb-3">
            <label for="total_bayar" class="form-label">Total Bayar</label>
            <input type="number" name="total_bayar" class="form-control" value="{{ $penyewaan->total_bayar }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
