@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">📋 Daftar Kebaya</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.kebayas.create') }}" class="btn btn-outline-primary">
            ➕ Tambah Kebaya
        </a>
        <input type="text" class="form-control w-25" placeholder="🔍 Cari kebaya...">
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama Kebaya</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($kebayas as $kebaya)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($kebaya->foto)
                                <img src="{{ asset($kebaya->foto) }}" alt="Foto" width="60" class="rounded shadow-sm">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $kebaya->nama }}</td>
                        <td><span class="badge bg-success">Rp {{ number_format($kebaya->harga_sewa, 0, ',', '.') }}</span></td>
                        <td class="text-center">
                            <a href="{{ route('admin.kebayas.show', $kebaya->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                            <a href="{{ route('admin.kebayas.edit', $kebaya->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('admin.kebayas.destroy', $kebaya->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-outline-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada data kebaya.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
