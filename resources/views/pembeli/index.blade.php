@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="p-5">
    <div class="row">
        <div class="col-12">
            <h1>Pilih Kantin</h1>
            <div class="row justify-content-start">
                @forelse ($ruko as $rukos)
                @if ($rukos->id_kantin != '')
                    @foreach ($menu as $menus)
                        @if ($menus->id_user == $rukos->id_user)
                        <div class="col-lg-3 col-12 pb-3">
                            <div class="card" style="height: 100%; width:100%">
                                <div class="card-body">
                                    <h4 class="card-title fw-bold">{{ $rukos->nama_ruko }}</h4>
                                    <h4 class="card-title">
                                        @foreach ($kantin as $kantins)
                                            @if ($kantins->id == $rukos->id_kantin)
                                                {{ $kantins->nama_kantin }}
                                            @endif
                                        @endforeach
                                    </h4>
                                    <a href="/kantin/{{ $rukos->id }}" class="btn btn-success">Lihat</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
                @empty
                <div class="col-3">
                    <div class="card" style="height: 100%; width:100%">
                        <div class="card-body">
                            <h4 class="card-title fw-bold">Tidak ada kantin</h4>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
