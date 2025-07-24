@extends('layouts.app')

@section('content')
<h1>Tambah Kebaya</h1>

<form action="{{ route('admin.kebayas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kebaya</label>
        <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
        @error('nama')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="harga_sewa" class="form-label">Harga Sewa</label>
        <input type="number" name="harga_sewa" class="form-control" id="harga_sewa" value="{{ old('harga_sewa') }}" required>
        @error('harga_sewa')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto Kebaya</label>
        <input type="file" name="foto" class="form-control" id="foto">
        @error('foto')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.kebayas.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
