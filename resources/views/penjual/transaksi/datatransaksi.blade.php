@extends('penjual.layout')

@section('title', 'Data Transaksi')

@section('judul', 'Data Transaksi')

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
        <h5 class="col-12 col-lg-6 fw-bold">Data Transaksi</h5>
        <div class="col-12 col-lg-6 d-flex justify-content-end">
                <form action="/dataakun/search" method="get" class="col-7 me-2">
                    <input class="form-control" type="text" name="cari" value="{{ old('cari') }}"  placeholder="Cari pesanan ..." aria-label="Search">
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
                <th scope="col">No Transaksi</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Metode Pembayaran</th>
                <th scope="col">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            foreach ($ruko as $rukos){
                if($rukos->id_user == Auth::user()->id){
                    $id_ruko = $rukos->id;
                }
            }

            foreach($pesanan as $pesanans){
                if($pesanans->id_ruko == $id_ruko){
                    $cek = $pesanans->id_transaksi;
            @endphp
            @foreach ($data as $datas)

            @if ($datas->id == $cek)
                <tr>
                    <th scope="col" class="text-center">{{ $no++ }}</th>
                    <td scope="col">{{ $datas->id }}</td>
                    @foreach ($user as $nama_user)
                    @if ($nama_user->id == $datas->id_user)
                    <td scope="col">{{ $nama_user->name }}</td>
                    @endif
                    @endforeach
                    <td scope="col">{{ $datas->total_harga }}</td>
                    <td scope="col">{{ $datas->metode_pembayaran }}</td>
                    <td scope="col">{{ $datas->catatan }}</td>
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
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Batas Modal --}}

                @endif
            @endforeach
            @php
                }
            }
            @endphp
        </tbody>
    </table>
</div>
@endsection
