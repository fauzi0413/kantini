@extends('admin.layout')

@section('title', 'Tambah Ruko')

@section('judul', 'Tambah Ruko')

@section('konten_admin')

<div class="card bg-white border-0 shadow p-4" style="min-height: 70vh">
    <div class="mb-3">
        <a href="/dataruko" class="btn btn-sm btn-outline-danger fw-bold me-2">Kembali</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Ruko</label>
            <input type="text" value="{{ old('name') }}" name="name" class="bg-white form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Ruko">
            @error('name')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label for="barcode" class="form-label fw-bold">Barcode QRIS</label>
            <input type="file" name="barcode" class="form-control">
            @error('barcode')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label for="kantin" class="form-label fw-bold">Posisi Ruko</label>
            <select class="form-select bg-white" aria-label="Default select example" name="kantin">
                @foreach ($data as $datas)
                <option value="{{ $datas->id }}">{{ $datas->nama_kantin }}</option>
                @endforeach
            </select>
            @error('kantin')
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
