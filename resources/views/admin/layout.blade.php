@extends('layouts.app')

@section('content')
    <style>
        footer{
            display: none;
        }
    </style>

    <div class="row m-0" style="min-height: 100vh">
        <div class="col-2 bg-info text-white shadow d-none d-lg-block">
            <div class="py-4">
                <ul class="fw-bold p-2">
                    <li class="list-unstyled opacity-75 mb-3" style="font-size: 12px">PAGES</li>

                    <a href="/" class="text-decoration-none text-white">
                        <li class="list-unstyled fs-5 mb-3"><i class="fa-solid fa-chart-simple me-2"></i> Dashboard</li>
                    </a>

                    <a href="/" class="text-decoration-none text-white">
                        <a class="nav-link collapsed fs-5 mb-3" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                            <i class="fa-solid fa-street-view me-2"></i> Data Akun<i class="fa-solid fa-chevron-down ms-3 fs-6"></i>
                        </a>
                        <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                            <a href="/dataakun" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>All</li>
                            </a>
                            <a href="/dataakun/user" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>User</li>
                            </a>
                            <a href="/dataakun/penjual" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>Penjual</li>
                            </a>
                            <a href="/dataakun/admin" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>Admin</li>
                            </a>
                        </ul>
                    </a>

                    <a href="/datakantin" class="text-decoration-none text-white">
                        <li class="list-unstyled fs-5 mb-3"><i class="fa-solid fa-shop me-2"></i> Data Kantin</li>
                    </a>

                    <a href="/dataruko" class="text-decoration-none text-white">
                        <li class="list-unstyled fs-5 mb-3"><i class="fa-solid fa-store me-2"></i> Data Ruko</li>
                    </a>

                </ul>
            </div>
        </div>

        <div class="col-lg-10 col-12">
            <div class="container py-4">
                <h3 class="fw-bold mb-3">@yield('judul')</h3>
                @yield('konten_admin')
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="asider" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">
                <a class="navbar-brand" href="{{ '/' }}"><img src="{{ asset('logodanteks.png') }}" alt="Logo Sanora" style="width: 100px"></a>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body bg-info">
            <div class="">
                <ul class="fw-bold p-2">
                    <li class="list-unstyled opacity-75 mb-3 text-white" style="font-size: 12px">PAGES</li>

                    <a href="/" class="text-decoration-none text-white">
                        <li class="list-unstyled fs-5 mb-3"><i class="fa-solid fa-chart-simple me-2"></i> Dashboard</li>
                    </a>
                    <a href="/dataakun" class="text-decoration-none text-white">
                        <a class="nav-link collapsed fs-5 mb-3 text-white" data-bs-target="#tables-akun" data-bs-toggle="collapse" href="#">
                            <i class="fa-solid fa-street-view me-2"></i> Data Akun<i class="fa-solid fa-chevron-down ms-3 fs-6"></i>
                        </a>
                        <ul id="tables-akun" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <a href="/dataakun" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>All</li>
                            </a>
                            <a href="/dataauthor" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>Author</li>
                            </a>
                            <a href="/dataadmin" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>Admin</li>
                            </a>
                        </ul>
                    </a>
                    <a href="/dataartikel" class="text-decoration-none text-white">
                        <a class="nav-link collapsed fs-5 mb-3 text-white" data-bs-target="#artikel" data-bs-toggle="collapse" href="#">
                            <i class="fa-regular fa-folder-open me-2"></i> Data Artikel<i class="fa-solid fa-chevron-down ms-3 fs-6"></i>
                        </a>
                        <ul id="artikel" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <a href="/dataartikel" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>All</li>
                            </a>
                            <a href="/dataartikel_menunggu" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>Menunggu</li>
                            </a>
                            <a href="/dataartikel_disetujui" class="text-decoration-none text-white">
                                <li class="list-unstyled mb-3"><i class="fa-regular fa-circle me-2"></i></i>Disetujui</li>
                            </a>
                        </ul>
                    </a>
                </ul>
            </div>
        </div>
        </div>
    </div>

@endsection
