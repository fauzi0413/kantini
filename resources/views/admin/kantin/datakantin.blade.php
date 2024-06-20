@extends('admin.layout')

@section('title', 'Data Kantin')

@section('judul', 'Data Kantin')

@section('konten_admin')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif (session()->has('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('danger') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card bg-white border-0 shadow p-4" style="min-height: 70vh">
    <div class="row justify-content-between mb-3">
        <h5 class="col-12 col-lg-6 fw-bold">Data Kantin</h5>
        <div class="col-12 col-lg-6 d-flex justify-content-end">
                <form action="/dataakun/search" method="get" class="col-7 me-2">
                    <input class="form-control" type="text" name="cari" value="{{ old('cari') }}"  placeholder="Cari kantin ..." aria-label="Search">
                </form>

            <div class="me-2">
                <a href="/datakantin/create" class="text-decoration-none btn btn-sm btn-success d-none d-lg-block">Tambah <i class="fa-solid fa-plus"></i></a>
                <a href="/datakantin/create" class="text-decoration-none btn btn-sm btn-success d-lg-none d-block"><i class="fa-solid fa-plus"></i></a>
            </div>

            {{-- @if ($status == 'Admin')
                <div class="">
                    <a href="/generatepdfadmin" target="_blank" class="text-decoration-none btn btn-sm btn-danger d-none d-lg-block">Laporan <i class="fa-solid fa-file-pdf"></i></a>
                    <a href="/generatepdfadmin" target="_blank" class="text-decoration-none btn btn-sm btn-danger d-lg-none d-block"><i class="fa-solid fa-file-pdf"></i></a>
                </div>
            @else
                <div class="">
                    <a href="/generatepdf" target="_blank" class="text-decoration-none btn btn-sm btn-danger d-none d-lg-block">Laporan <i class="fa-solid fa-file-pdf"></i></a>
                    <a href="/generatepdf" target="_blank" class="text-decoration-none btn btn-sm btn-danger d-lg-none d-block"><i class="fa-solid fa-file-pdf"></i></a>
                </div>
            @endif --}}
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col">Nama Kantin</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $datas)
                <tr>
                    <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                    <td scope="col">
                        <a type="button" class="fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#detailAkun{{ $datas->id }}">{{ $datas->nama_kantin }}</a>
                    </td>
                    <td scope="col" class="text-center">
                        <a href="/datakantin/edit/{{ $datas->id }}"><span class="text-dark"><i class="fa-regular fa-pen-to-square"></i></span></a>
                        <a href="/datakantin/delete/{{ $datas->id }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><span class="text-danger ms-lg-3"><i class="fa-regular fa-trash-can"></i></span></a>
                    </td>
                </tr>

                <!-- Modal Catatan -->
                <div class="modal fade" id="detailAkun{{ $datas->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Detail Kantin</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-5 col-md-4 label fw-bold mb-3">Nama Ruko</div>
                                    <div class="col-6">
                                        <ul>
                                            @foreach ($ruko as $rukos)
                                            @if ($rukos->id_kantin == $datas->id)
                                            <li>{{ $rukos->nama_ruko }}</li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Batas Modal --}}

            @endforeach
        </tbody>
    </table>
</div>
@endsection
