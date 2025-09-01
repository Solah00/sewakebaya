<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kebaya Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e2e8f0;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 0;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            gap: 8px;
        }
        .sidebar a.active,
        .sidebar a:hover {
            color: #0d6efd;
        }
        .content {
            margin-left: 240px;
            padding: 30px;
            min-height: 100vh;
        }
        .navbar {
            background-color: #ffffff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .navbar form input[type="search"] {
            width: 100%;
        }
        .navbar .d-flex.align-items-center > i {
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Kebaya Rental</h4>

  <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>

<a href="{{ route('admin.kebayas.index') }}">
    <i class="bi bi-ui-checks-grid"></i> Data Kebaya
</a>

<a href="{{ route('admin.penyewaan.index') }}">
    <i class="bi bi-bag-check"></i> Penyewaan
</a>

<a href="{{ route('admin.pelanggan.index') }}">
    <i class="bi bi-people"></i> Pelanggan
</a>

<a href="{{ route('admin.pembayaran.index') }}">
    <i class="bi bi-wallet2"></i> Pembayaran
</a>

<a href="{{ route('admin.laporan.index') }}">
    <i class="bi bi-bar-chart"></i> Laporan
</a>

<!-- <a href="#">
    <i class="bi bi-gear"></i> Pengaturan
</a> -->


    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Top Navbar -->
        <div class="navbar">
            <form class="w-50">
                <input type="search" class="form-control" placeholder="🔍 Cari..." />
            </form>
            <div class="d-flex align-items-center gap-3">
    

    <!-- Dropdown -->
    <div class="d-flex align-items-center gap-3">
    <i class="bi bi-bell fs-5"></i>

    <div class="dropdown">
        <a href="#" class="text-decoration-none" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-4"></i> {{-- Ikon admin --}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="#">Profil</a></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        </div>

        <!-- Dynamic Content -->
        @yield('content')
    </div>

</body>
</html>
