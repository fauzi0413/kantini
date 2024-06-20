@extends('admin.layout')

@section('title', 'Ubah Ruko')

@section('judul', 'Ubah Ruko')

@section('konten_admin')

<div class="card bg-white border-0 shadow p-4" style="min-height: 70vh">
    <div class="mb-3">
        <a href="/dataruko" class="btn btn-sm btn-outline-danger fw-bold me-2">Kembali</a>
    </div>
    <form action="/dataruko/edit/{{ $data->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Ruko</label>
            <input type="text" value="{{ $data->nama_ruko }}" name="name" class="bg-white form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Ruko">
            @error('name')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_telpon" class="form-label fw-bold">No Telpon</label>
            <input type="text" value="{{ $data->no_telpon }}" name="no_telpon" class="bg-white form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nomor Telpon">
            @error('name')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kantin" class="form-label fw-bold">Posisi Ruko</label>
            <select class="form-select bg-white" aria-label="Default select example" name="kantin">
                @foreach ($kantins as $datas)
                    @if ($datas->id == $data->id_kantin)
                        <option selected value="{{ $datas->id }}">{{ $datas->nama_kantin }}</option>
                    @else
                        <option value="{{ $datas->id }}">{{ $datas->nama_kantin }}</option>
                    @endif
                @endforeach
            </select>
            @error('kantin')
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
