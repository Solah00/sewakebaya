<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Kebaya Cantik')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet" />
    <style>
        /* CSS dari welcome.blade.php di sini */
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
        <a class="navbar-brand fw-bold fs-4 text-danger" href="{{ url('/') }}">Kebaya Cantik</a>
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

{{-- Konten Dinamis --}}
@yield('content')

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
                <p><i class="bi bi-geo-alt"></i> Jl. pancor </p>
                <p><i class="bi bi-telephone"></i> 0812-3456-7890</p>
                <p><i class="bi bi-envelope"></i> info@kebayacantik.com</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        &copy; {{ date('Y') }} Kebaya Cantik - All Rights Reserved
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function tampilkanSemuaUlasan(kebayaId, tombol) {
        const items = document.querySelectorAll('.ulasan-item.kebaya-' + kebayaId);
        items.forEach(item => item.style.display = 'flex');
        tombol.style.display = 'none';
    }
</script>

</body>
</html>
