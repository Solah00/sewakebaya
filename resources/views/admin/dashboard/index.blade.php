@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
        <div>
            <button class="btn btn-secondary" onclick="window.location='{{ route('admin.kebayas.create') }}'">Tambah Kebaya</button>
            <button class="btn btn-primary" onclick="window.location='{{ route('admin.penyewaan.create') }}'">Buat Transaksi Baru</button>
            <button class="btn btn-outline-secondary" onclick="window.location='{{ route('admin.laporan.index') }}'">Cetak Laporan</button>
        </div>
    </div>

    {{-- Cards Section --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Kebaya</h6>
                    <h3>{{ $totalKebaya }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Penyewaan</h6>
                    <h3>{{ $totalPenyewaan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Pelanggan</h6>
                    <h3>{{ $totalPelanggan }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Penyewaan Per Bulan</h5>
                    <canvas id="penyewaanChart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Kebaya Favorit</h5>
            <div style="max-width: 400px; margin: auto;">
                <canvas id="favoritChart" style="max-width: 100%; height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>

    </div>

    {{-- Penyewaan Terbaru --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Penyewaan Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Kebaya</th>
                            <th>Tgl Sewa</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penyewaanTerbaru as $i => $penyewaan)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $penyewaan->pelanggan->nama }}</td>
                            <td>{{ $penyewaan->kebaya->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $penyewaan->status == 'Disewa' ? 'warning' : 'success' }}">
                                    {{ $penyewaan->status }}
                                </span>
                            </td>
                            <td>
                                @for ($s = 0; $s < 5; $s++)
                                    <i class="fa{{ $s < $penyewaan->rating ? 's' : 'r' }} fa-star text-warning"></i>
                                @endfor
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada penyewaan terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart Penyewaan per bulan (line chart)
    const ctx1 = document.getElementById('penyewaanChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($penyewaanPerBulan ?? [])) !!},
            datasets: [{
                label: 'Jumlah Penyewaan',
                data: {!! json_encode(array_values($penyewaanPerBulan ?? [])) !!},
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                tension: 0.3,
                pointRadius: 4
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    // Chart Kebaya Favorit (pie chart)
const ctx2 = document.getElementById('favoritChart').getContext('2d');
new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: {!! json_encode($labels ?? []) !!},
        datasets: [{
            label: 'Jumlah Disewa',
            data: {!! json_encode($data ?? []) !!},
            backgroundColor: [
                '#4ade80',
                '#60a5fa',
                '#facc15',
                '#f87171',
                '#a78bfa'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,  // Supaya height canvas bisa dipakai sesuai style
        plugins: {
            legend: { display: true, position: 'right' }
        }
    }
});

</script>

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection
