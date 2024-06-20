@extends('admin.layout')

@section('title', 'Ubah Kantin')

@section('judul', 'Ubah Kantin')

@section('konten_admin')

<div class="card bg-white border-0 shadow p-4" style="min-height: 70vh">
    <div class="mb-3">
        <a href="/datakantin" class="btn btn-sm btn-outline-danger fw-bold me-2">Kembali</a>
    </div>
    <form action="/datakantin/edit/{{ $data->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Kantin</label>
            <input type="text" value="{{ $data->nama_kantin }}" name="name" class="bg-white form-control @error('name') is-invalid @enderror">
            @error('name')
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
