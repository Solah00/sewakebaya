@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Dashboard</h2>
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Kebaya</h6>
                    <h3>{{ $totalKebaya }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Penyewaan</h6>
                    <h3>{{ $totalPenyewaan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Pelanggan</h6>
                    <h3>{{ $totalPelanggan }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Penyewaan --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5>Penyewaan per Bulan</h5>
            <canvas id="penyewaanChart" height="100"></canvas>
        </div>
    </div>

    {{-- Tabel Penyewaan Terbaru --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Penyewaan Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Sewa</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Sewa</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penyewaanTerbaru as $penyewaan)
                            <tr>
                                <td>{{ $penyewaan->kode_sewa }}</td>
                                <td>{{ $penyewaan->nama_pelanggan }}</td>
                                <td>{{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}</td>
                                <td>Rp {{ number_format($penyewaan->total_bayar, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data penyewaan terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('penyewaanChart');
    const penyewaanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($penyewaanPerBulan ?? [])) !!},
            datasets: [{
                label: 'Jumlah Penyewaan',
                data: {!! json_encode(array_values($penyewaanPerBulan ?? [])) !!},
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
