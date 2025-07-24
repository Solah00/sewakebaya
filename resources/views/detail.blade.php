<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kebaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $kebaya->nama_kebaya }}</h1>

        <div class="row">
            <!-- Gambar Kebaya -->
            <div class="col-md-6 mb-4">
                @if($kebaya->gambar)
                    <img src="{{ asset('storage/' . $kebaya->gambar) }}" class="img-fluid" alt="{{ $kebaya->nama_kebaya }}">
                @else
                    <img src="https://via.placeholder.com/400x300?text=No+Image" class="img-fluid" alt="Image not available">
                @endif
            </div>

            <!-- Detail Kebaya -->
            <div class="col-md-6">
                <h4>Harga Sewa: Rp {{ number_format($kebaya->harga_sewa, 0, ',', '.') }}</h4>
                <p><strong>Deskripsi:</strong></p>
                <p>{{ $kebaya->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>

                <!-- Tombol untuk sewa -->
                <a href="#" class="btn btn-success">Sewa Kebaya</a>
            </div>
        </div>

        <h3 class="mt-5">Kebaya Terkait</h3>
        <div class="row">
            @foreach($relatedKebayas as $relatedKebaya)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($relatedKebaya->gambar)
                            <img src="{{ asset('storage/' . $relatedKebaya->gambar) }}" class="card-img-top" alt="{{ $relatedKebaya->nama_kebaya }}">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="Image not available">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedKebaya->nama_kebaya }}</h5>
                            <p class="card-text">Rp {{ number_format($relatedKebaya->harga_sewa, 0, ',', '.') }}</p>
                            <a href="{{ route('kebaya.detail', $relatedKebaya->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
