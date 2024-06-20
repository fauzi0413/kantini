@extends('penjual.layout')

@section('title', 'Ubah Menu')

@section('judul', 'Ubah Menu')

@section('konten_admin')

<div class="card bg-white border-0 shadow p-4" style="min-height: 70vh">
    <div class="mb-3">
        <a href="/datamenu" class="btn btn-sm btn-outline-danger fw-bold me-2">Kembali</a>
    </div>
    <form action="/datamenu/edit/{{ $data->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Menu</label>
            <input type="text" value="{{ $data->nama_menu }}" name="name" class="bg-white form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Menu">
            @error('name')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label fw-bold">Harga Menu</label>
            <input type="text" value="{{ $data->harga_menu }}" name="harga" class="bg-white form-control @error('harga') is-invalid @enderror" placeholder="Masukkan Harga Menu">
            @error('harga')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi Menu</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="bg-white form-control" @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi Menu">{{ $data->deskripsi }}</textarea>
            @error('deskripsi')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label fw-bold">Gambar Menu</label>
            <input type="file" name="gambar" class="form-control" value="{{ $data->gambar_menu }}">
            @error('gambar')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <button name="submit" type="submit" class="btn btn-info text-white" onclick="return confirm('Apakah anda yakin ingin mengubah data tersebut?')">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
