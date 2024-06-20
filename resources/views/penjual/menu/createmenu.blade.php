@extends('penjual.layout')

@section('title', 'Tambah Menu')

@section('judul', 'Tambah Menu')

@section('konten_admin')

<div class="card bg-white border-0 shadow p-4" style="min-height: 70vh">
    <div class="mb-3">
        <a href="/datamenu" class="btn btn-sm btn-outline-danger fw-bold me-2">Kembali</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Menu</label>
            <input type="text" value="{{ old('name') }}" name="name" class="bg-white form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Menu">
            @error('name')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label fw-bold">Harga Menu</label>
            <input type="text" value="{{ old('harga') }}" name="harga" class="bg-white form-control @error('harga') is-invalid @enderror" placeholder="Masukkan Harga Menu">
            @error('harga')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi Menu</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="bg-white form-control" @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi Menu">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label fw-bold">Gambar Menu <span class="text-danger">*Format file: png, jpg, jpeg</span></label>
            <input type="file" name="gambar" class="form-control" value="{{ old('gambar') }}">
            @error('gambar')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <button name="submit" type="submit" class="btn btn-info text-white" onclick="return confirm('Apakah anda yakin ingin menambahkan data tersebut?')">Submit</button>
        </div>
    </form>
</div>

@endsection
