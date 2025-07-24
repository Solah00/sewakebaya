@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Penyewaan</h1>

    <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="col-md-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.laporan.exportCsv', request()->all()) }}" class="btn btn-success">Export CSV</a>
        </div>
    </form>

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Sewa</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Sewa</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penyewaan as $item)
            <tr>
                <td>{{ $loop->iteration + ($penyewaan->currentPage() - 1) * $penyewaan->perPage() }}</td>
                <td>{{ $item->kode_sewa }}</td>
                <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                <td>{{ $item->tanggal_sewa }}</td>
                <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Data tidak ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $penyewaan->links() }}
</div>
@endsection
