@extends('layouts.app')

@section('title', 'Kantin')

@section('content')
<div class="p-5">

    <div class="mb-3">
        <a href="/" class="btn btn-sm btn-outline-danger fw-bold me-2">Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-4 col-12 bg-white shadow rounded-3 d-block d-lg-none mb-5">
            <h2 class="text-center fw-bold p-3">Keranjang</h2>
            @if (empty($cart) || count($cart) == 0)
            Silahkan Pilih Menu
            @else
                <table>
                    <tr>
                        <th class="col-5">Nama Menu</th>
                        <th class="col-3">Jumlah</th>
                        <th class="col-4">Sub Total</th>
                    </tr>
                    @php
                        $no = 1;
                        $grandtotal = 0;
                    @endphp
                    @foreach ($cart as $ct => $val)
                    @php
                            $subtotal = $val["harga_produk"] * $val["jumlah"];
                    @endphp
                        <tr>
                            <div class="row">
                                <td class="col-5">
                                    <div class="col-12">{{ $val["nama_produk"] }}</div>
                                    <div class="col-12">Rp. {{ number_format($val["harga_produk"],0,',','.') }}</div>
                                </td>
                                <td class="col-4">
                                    <form action="/jumlah/tambah/{id}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $ct }}" name="id">
                                        <input type="number" value="{{ $val["jumlah"] }}" min="1" name="quantity" class="form-control">
                                        {{-- <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i></button> --}}
                                    </form>
                                </td>
                                <td class="col-3">
                                    <div class="col-12">Rp. {{ number_format($subtotal,0,',','.') }}</div>
                                </td>
                                <td><a href="/cart/hapus/{{ $ct }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </div>
                        </tr>
                        <tr class="border-bottom">
                            <th class="py-3">Catatan Pesanan</th>
                            <th colspan="6" class="py-3">
                                <form action="/catatan/tambah/{id}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $ct }}" name="id">
                                    <input type="text" value="{{ $val["catatan"] }}" name="catatan_pesanan" class="form-control">
                                </form>
                            </th>
                        </tr>
                        @php
                        $grandtotal += $subtotal;
                        @endphp
                    @endforeach
                    <tr>
                        <th class="pt-3">Total Bayar</th>
                        <th class="pt-3">Rp. {{ number_format($grandtotal,0,',','.') }}</th>
                    </tr>
                    <tr>
                        <th class="py-3">Catatan</th>
                        <th colspan="6" class="py-3">
                            <form action="/transaksi/tambah" method="POST">
                                @csrf
                                <input type="text" name="catatan_transaksi" class="form-control">
                            </form>
                        </th>
                    </tr>
                </table>
                <a href="/transaksi/tambah" class="btn btn-success w-full col-12 mb-4">Bayar</a>
            @endif
        </div>

        <div class="col-lg-8 col-12">
            <h1>Menu {{ $ruko->nama_ruko }}</h1>
            <div class="row justify-content-start">
                @forelse ($data as $datas)
                <div class="col-lg-4 col-12 mb-3">
                    <div class="card" style="height: 100%; width:100%">
                        <img src="{{ asset('./storage/menu/'.$datas->gambar_menu ) }}" class="card-img-top" alt="Gambar {{ $datas->nama_menu }}">
                        <div class="card-body">
                        <h4 class="card-title fw-bold">{{ $datas->nama_menu }}</h4>
                        <h5 class="card-title">Rp. {{ number_format($datas->harga_menu,0,',','.') }}</h5>
                        <p class="card-text">{{ $datas->deskripsi }}</p>

                        @if (empty($cart) || count($cart) == 0)
                            <a href="/cart/tambah/{{ $datas->id }}" class="btn btn-success">Pesan</a>
                        @else
                            @foreach ($cart as $ct => $val)
                                @if($val["ruko"] == $ruko->id)
                                    <a href="/cart/tambah/{{ $datas->id }}" class="btn btn-success">Pesan</a>
                                @endif
                                @break
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>

        <div class="col-lg-4 col-12 bg-white shadow rounded-3 d-none d-lg-block">
            <h2 class="text-center fw-bold p-3">Keranjang</h2>
            @if (empty($cart) || count($cart) == 0)
            Silahkan Pilih Menu
            @else
                <table>
                    <tr>
                        <th class="col-5">Nama Menu</th>
                        <th class="col-3">Jumlah</th>
                        <th class="col-4">Sub Total</th>
                    </tr>
                    @php
                        $no = 1;
                        $grandtotal = 0;
                    @endphp
                    @foreach ($cart as $ct => $val)
                    @php
                            $subtotal = $val["harga_produk"] * $val["jumlah"];
                    @endphp
                        <tr>
                            <div class="row">
                                <td class="col-5">
                                    <div class="col-12">{{ $val["nama_produk"] }}</div>
                                    <div class="col-12">Rp. {{ number_format($val["harga_produk"],0,',','.') }}</div>
                                </td>
                                <td class="col-4">
                                    <form action="/jumlah/tambah/{id}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $ct }}" name="id">
                                        <input type="number" value="{{ $val["jumlah"] }}" min="1" name="quantity" class="form-control">
                                        {{-- <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i></button> --}}
                                    </form>
                                </td>
                                <td class="col-3">
                                    <div class="col-12">Rp. {{ number_format($subtotal,0,',','.') }}</div>
                                </td>
                                <td><a href="/cart/hapus/{{ $ct }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </div>
                        </tr>
                        <tr class="border-bottom">
                            <th class="py-3">Catatan Pesanan</th>
                            <th colspan="6" class="py-3">
                                <form action="/catatan/tambah/{id}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $ct }}" name="id">
                                    <input type="text" value="{{ $val["catatan"] }}" name="catatan_pesanan" class="form-control">
                                </form>
                            </th>
                        </tr>
                        @php
                        $grandtotal += $subtotal;
                        @endphp
                    @endforeach
                    <tr>
                        <th class="pt-3">Total Bayar</th>
                        <th class="pt-3">Rp. {{ number_format($grandtotal,0,',','.') }}</th>
                    </tr>
                    <tr>
                        <th class="py-3">Catatan</th>
                        <th colspan="6" class="py-3">
                            <form action="/transaksi/tambah" method="POST">
                                @csrf
                                <input type="text" name="catatan_transaksi" class="form-control">
                            </form>
                        </th>
                    </tr>
                </table>
                <a href="/transaksi/tambah" class="btn btn-success w-full col-12 mb-4">Bayar</a>
            @endif
        </div>
    </div>
</div>
@endsection
