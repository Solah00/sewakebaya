@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kebaya Baru</h1>

    <form action="{{ route('admin.kebaya.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_kebaya" class="form-label">Nama Kebaya</label>
            <input type="text" class="form-control" id="nama_kebaya" name="nama_kebaya" required>
        </div>
        <div class="mb-3">
            <label for="harga_sewa" class="form-label">Harga Sewa</label>
            <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
