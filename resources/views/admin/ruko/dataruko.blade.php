@extends('admin.layout')

@section('title', 'Data Ruko')

@section('judul', 'Data Ruko')

@section('konten_admin')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card bg-white border-0 shadow p-4" style="min-height: 70vh">
    <div class="row justify-content-between mb-3">
        <h5 class="col-12 col-lg-6 fw-bold">Data Ruko</h5>
        <div class="col-12 col-lg-6 d-flex justify-content-end">
                <form action="/dataakun/search" method="get" class="col-7 me-2">
                    <input class="form-control" type="text" name="cari" value="{{ old('cari') }}"  placeholder="Cari ruko ..." aria-label="Search">
                </form>

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
                <th scope="col">Nama Penjual</th>
                <th scope="col">Nama Ruko</th>
                <th scope="col">Posisi Ruko</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $datas)
                <tr>
                    <th scope="col" class="text-center">{{ $loop->iteration }}</th>
                    <td>
                    @foreach ($penjuals as $penjual)
                        @if ($penjual->id == $datas->id_user)
                        {{ $penjual->name}}
                        @endif
                    @endforeach</td>
                    <td scope="col">
                        <a type="button" class="fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#detailAkun{{ $datas->id }}">{{ $datas->nama_ruko }}</a>
                    </td>
                    <td>
                        @foreach ($kantins as $kantin)
                        @if ($kantin->id == $datas->id_kantin)
                        {{ $kantin->nama_kantin }}
                        @endif
                        @endforeach
                    <td scope="col" class="text-center">
                        <a href="/dataruko/edit/{{ $datas->id }}"><span class="text-dark"><i class="fa-regular fa-pen-to-square"></i></span></a>
                        <a href="/dataruko/delete/{{ $datas->id }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><span class="text-danger ms-lg-3"><i class="fa-regular fa-trash-can"></i></span></a>
                    </td>
                </tr>

                <!-- Modal Catatan -->
                <div class="modal fade" id="detailAkun{{ $datas->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Detail Ruko</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center mb-5">
                                    @if ( empty($datas->profile) )
                                        <h1><i class="fa-regular fa-user bg-white shadow-sm rounded-circle p-5"></i></h1>
                                    @else
                                        <img src="{{ asset('./QRIS_Barcode/'. $datas->metode_pembayaran ) }}" alt="Barcode {{ $datas->nama_ruko }}" style="width: 150px; height: 150px; background-size: cover" class="shadow my-5">
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-5 col-md-4 label fw-bold mb-3">Nama Penjual</div>
                                    <div class="col-6">
                                        @foreach ($penjuals as $penjual)
                                            @if ($penjual->id == $datas->id_user)
                                                {{ $penjual->name}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 col-md-4 label fw-bold mb-3">Nama Ruko</div>
                                    <div class="col-6">{{ $datas->nama_ruko }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5 col-md-4 label fw-bold mb-3">No Telpon</div>
                                    <div class="col-6">{{ $datas->no_telpon }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-5 col-md-4 label fw-bold mb-3">Posisi Ruko</div>
                                    <div class="col-6">
                                        @foreach ($kantins as $kantin)
                                        @if ($kantin->id == $datas->id_kantin)
                                        {{ $kantin->nama_kantin }}
                                        @endif
                                        @endforeach
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
