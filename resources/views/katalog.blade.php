@extends('layouts.frontend')


@section('title', 'Katalog Kebaya')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-danger">Katalog Kebaya</h2>
        <p class="text-muted">Temukan koleksi kebaya terbaik untuk berbagai acara spesial Anda.</p>
    </div>

    {{-- Filter & Pencarian --}}
    <div class="row mb-4 align-items-center">
        <div class="col-md-6 mb-2">
            <form method="GET" action="{{ route('katalog') }}">
                <div class="input-group">
                    <input type="text" name="cari" class="form-control" placeholder="Cari kebaya..." value="{{ request('cari') }}">
                    <button class="btn btn-outline-danger" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-3 mb-2">
            <form method="GET" action="{{ route('katalog') }}">
                <select name="kategori" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="modern" {{ request('kategori') == 'modern' ? 'selected' : '' }}>Modern</option>
                    <option value="tradisional" {{ request('kategori') == 'tradisional' ? 'selected' : '' }}>Tradisional</option>
                    <option value="pernikahan" {{ request('kategori') == 'pernikahan' ? 'selected' : '' }}>Pernikahan</option>
                    <option value="wisuda" {{ request('kategori') == 'wisuda' ? 'selected' : '' }}>Wisuda</option>
                </select>
            </form>
        </div>
    </div>

    {{-- Grid Kebaya --}}
    <div class="row g-4">
        @forelse ($kebayas as $kebaya)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $kebaya->gambar ? asset('uploads/' . $kebaya->gambar) : asset('images/default-kebaya.jpg') }}" 
                         class="card-img-top" style="height: 280px; object-fit: cover;" alt="{{ $kebaya->nama }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $kebaya->nama }}</h5>
                        <p class="text-danger fw-bold fs-5">Rp {{ number_format($kebaya->harga_sewa, 0, ',', '.') }}</p>
                        <p class="text-muted small">{{ Str::limit($kebaya->deskripsi, 80) ?? 'Kebaya elegan untuk acara spesial' }}</p>
                        <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20menyewa%20kebaya%20{{ urlencode($kebaya->nama) }}" 
                           target="_blank" class="btn btn-success mt-auto">
                            <i class="bi bi-whatsapp"></i> Sewa via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-warning">Tidak ada kebaya yang tersedia saat ini.</div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $kebayas->links() }}
    </div>
</div>
@endsection
