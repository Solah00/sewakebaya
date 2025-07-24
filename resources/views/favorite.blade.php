@extends('layouts.frontend')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Kebaya Favorit</h2>
    <div class="row g-4">
        @forelse ($kebayaFavorit as $favorit)
            @if ($favorit->kebaya)
                <div class="col-md-3">
                    <div class="card card-kebaya h-100">
                        <img src="{{ $favorit->kebaya->gambar ? asset('uploads/' . $favorit->kebaya->gambar) : asset('images/default-kebaya.jpg') }}"
                             class="card-img-top"
                             alt="{{ $favorit->kebaya->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorit->kebaya->nama }}</h5>
                            <p class="text-danger fw-bold fs-6">Rp {{ number_format($favorit->kebaya->harga_sewa, 0, ',', '.') }}</p>
                            <p class="text-muted mb-1">Disewa sebanyak: {{ $favorit->total_qty }} kali</p>
                            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20kebaya%20favorit%20{{ urlencode($favorit->kebaya->nama) }}"
                               target="_blank"
                               class="btn btn-wa w-100">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <p class="text-center">Belum ada kebaya favorit.</p>
        @endforelse
    </div>
</div>
@endsection
