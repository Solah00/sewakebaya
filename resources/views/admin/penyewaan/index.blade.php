@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Penyewaan</h2>
    <a href="{{ route('admin.penyewaan.create') }}" class="btn btn-primary mb-3">Tambah Penyewaan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Sewa</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Kebaya</th> {{-- Tambahan --}}
                    <th>Tanggal Sewa</th>
                    <th>Total Bayar</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyewaans as $penyewaan)
                    <tr>
                        <td>{{ $penyewaan->kode_sewa }}</td>
                        <td>{{ $penyewaan->pelanggan->nama ?? '-' }}</td>
                        <td>{{ $penyewaan->kebaya->nama ?? '-' }}</td> {{-- Diperbaiki --}}
                        <td>{{ $penyewaan->tanggal_sewa }}</td>
                        <td>Rp {{ number_format($penyewaan->total_bayar, 0, ',', '.') }}</td>
                        <td>{{ $penyewaan->qty }}</td>
                        <td>
                            <a href="{{ route('admin.penyewaan.edit', $penyewaan->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.penyewaan.destroy', $penyewaan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus penyewaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data penyewaan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
