<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Ruko;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DataPesanan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $ruko = Ruko::all();
        $menu = Menu::all();
        $transaksi = Transaksi::all();
        $data = Pesanan::orderBy('id', 'DESC')->get();
        return view('penjual.pesanan.datapesanan', compact('data', 'ruko', 'user', 'menu', 'transaksi'));
    }

    public function status($status,  $id)
    {
        $data = Pesanan::where('id', $id);
        $data->update([
            'status' => $status,
        ]);
        return redirect('/datapesanan')->with('success', 'Status Berhasil Diubah');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
