@extends('layouts.app')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title text-muted">Jumlah Kebaya</h5>
                <h3 class="fw-bold">{{ $jumlah_kebaya }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title text-muted">Pelanggan</h5>
                <h3 class="fw-bold">{{ $jumlah_pelanggan }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title text-muted">Penyewaan</h5>
                <h3 class="fw-bold">{{ $jumlah_penyewaan }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title text-muted">Pendapatan</h5>
                <h3 class="fw-bold">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
