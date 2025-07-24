@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pembayaran</h1>

    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Sewa</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Bayar</th>
                <th>Jumlah Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaran as $item)
            <tr>
                <td>{{ $loop->iteration + ($pembayaran->currentPage() - 1) * $pembayaran->perPage() }}</td>
                <td>{{ $item->penyewaan->kode_sewa ?? '-' }}</td>
                <td>{{ $item->penyewaan->tanggal_sewa ?? '-' }}</td>
                <td>{{ $item->tanggal_bayar }}</td>
                <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.pembayaran.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($pembayaran->isEmpty())
            <tr><td colspan="6" class="text-center">Belum ada data pembayaran.</td></tr>
            @endif
        </tbody>
    </table>

    {{ $pembayaran->links() }}
</div>
@endsection
