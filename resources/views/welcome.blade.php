<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kebaya Cantik - Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet" />
    <style>

        body {
            background: #fff;
            font-family: 'Poppins', sans-serif;
        }
        h1, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        .card-kebaya {
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        .card-kebaya:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }
        .card-img-top {
            height: 280px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .btn-wa {
            background-color: #25D366;
            color: white;
            font-weight: bold;
            border-radius: 8px;
        }
        .btn-wa:hover {
            background-color: #1ebe5d;
        }
        .rating {
            color: #fbc02d;
            font-size: 1.2rem;
        }
        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
        }
        footer {
            background: #f8f9fa;
            padding-top: 3rem;
            padding-bottom: 1rem;
            font-size: 0.95rem;
            color: #555;
        }
        .footer-bottom {
            background: #dc3545;
            color: #fff;
            padding: 0.8rem 0;
        }
        .hero-img {
    width: 100%;
    height: 360px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
@media (max-width: 768px) {
    .hero-img {
        height: 220px;
    }
}

        
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-danger" href="#">Kebaya Cantik</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('katalog') }}">Kebaya</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('favorite') }}">Favorit</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Akun</a></li>
</ul>

        </div>
    </div>
</nav>

{{-- Hero / Company Profile --}}
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold text-danger">Selamat Datang di Kebaya Cantik</h1>
            <p class="lead">Kami menyediakan penyewaan kebaya modern, tradisional, dan eksklusif untuk berbagai acara penting Anda seperti pernikahan, lamaran, wisuda, dan lainnya.</p>
            <a href="#katalog" class="btn btn-danger mt-3">Lihat Koleksi</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/hero.jpg') }}" class="hero-img" alt="Banner Kebaya">
        </div>
    </div>
</div>

{{-- Katalog Kebaya --}}
<div class="container pb-5" id="katalog">
    <h2 class="text-center mb-4">Koleksi Kebaya</h2>
    <div class="row g-4">
        @forelse ($kebayas as $kebaya)
            <div class="col-md-4">
                <div class="card card-kebaya h-100">
                   <img src="{{ $kebaya->gambar ? asset('uploads/' . $kebaya->gambar) : asset('images/default-kebaya.jpg') }}"
                        class="card-img-top" alt="{{ $kebaya->nama }}">

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $kebaya->nama }}</h5>
                            <p class="text-danger fw-bold fs-5">Rp {{ number_format($kebaya->harga_sewa, 0, ',', '.') }}</p>
                            <p class="text-muted">{{ $kebaya->deskripsi ?? 'Kebaya modern berwarna elegan' }}</p>

                            @php
                                $rating = round($kebaya->ulasan->avg('rating'));
                                $bintang = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                            @endphp
                            <div class="rating mb-2">{{ $bintang }}</div>

                            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20menyewa%20kebaya%20{{ urlencode($kebaya->nama) }}" target="_blank" class="btn btn-wa w-100 mb-3">Sewa via WhatsApp</a>

                            {{-- Form Ulasan --}}
                            <form action="{{ route('ulasan.store') }}" method="POST" class="text-start mb-3">
                                @csrf
                                <input type="hidden" name="kebaya_id" value="{{ $kebaya->id }}">
                                <div class="mb-2">
                                    <input type="text" name="nama_pengulas" class="form-control form-control-sm" placeholder="Nama Anda" required>
                                </div>
                                <div class="mb-2">
                                    <select name="rating" class="form-select form-select-sm" required>
                                        <option value="">Pilih Rating</option>
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}">{{ $i }} Bintang</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <textarea name="komentar" class="form-control form-control-sm" rows="2" placeholder="Komentar (opsional)"></textarea>
                                </div>
                                <button type="submit" class="btn btn-outline-danger btn-sm">Kirim Ulasan</button>
                            </form>

                            {{-- Ulasan Pengguna --}}
                            @if ($kebaya->ulasan->count())
                                <div class="mt-3">
                                    <h6 class="fw-bold">Ulasan:</h6>
                                    <div id="ulasan-{{ $kebaya->id }}">
                                        @foreach ($kebaya->ulasan as $index => $ulasan)
                                            <div class="d-flex align-items-start mb-2 ulasan-item kebaya-{{ $kebaya->id }}" style="{{ $index > 1 ? 'display: none;' : '' }}">
                                                <img src="https://via.placeholder.com/32" alt="user" class="avatar me-2">
                                                <div>
                                                    <strong>{{ $ulasan->nama_pengulas }}</strong><br>
                                                    <div class="text-warning" style="font-size: 1rem;">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $ulasan->rating)
                                                                ★
                                                            @else
                                                                ☆
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    @if ($ulasan->komentar)
                                                        <small class="text-muted">{{ $ulasan->komentar }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($kebaya->ulasan->count() > 2)
                                        <button class="btn btn-sm btn-outline-secondary" onclick="tampilkanSemuaUlasan({{ $kebaya->id }}, this)">Lihat Semua Ulasan</button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada kebaya tersedia.</p>
        @endforelse
    </div>
</div>

{{-- Kebaya Favorit --}}
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


{{-- Footer --}}
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h5 class="text-danger">Kebaya Cantik</h5>
                <p>Penyedia penyewaan kebaya terbaik dengan koleksi modern, elegan, dan tradisional. Kami siap membantu Anda tampil memukau di hari spesial Anda.</p>
            </div>
            <div class="col-md-3 mb-4">
                <h6>Menu</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-reset">Beranda</a></li>
                    <li><a href="#katalog" class="text-reset">Kebaya</a></li>
                    <li><a href="#" class="text-reset">Tentang Kami</a></li>
                    <li><a href="#" class="text-reset">Kontak</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h6>Kontak</h6>
                <p><i class="bi bi-geo-alt"></i> Jl. pancor</p>
                <p><i class="bi bi-telephone"></i> 0812-3456-7890</p>
                <p><i class="bi bi-envelope"></i> info@kebayacantik.com</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        &copy; {{ date('Y') }} Kebaya Cantik - All Rights Reserved
    </div>
</footer>

{{-- Script tombol ulasan --}}
<script>
    function tampilkanSemuaUlasan(kebayaId, tombol) {
        const items = document.querySelectorAll('.ulasan-item.kebaya-' + kebayaId);
        items.forEach(item => item.style.display = 'flex');
        tombol.style.display = 'none';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
