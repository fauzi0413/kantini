<?php

namespace App\Http\Controllers;

use App\Models\Kantin;
use App\Models\Ruko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataRuko extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ruko::all();
        $penjuals = User::join('Rukos', 'Rukos.id_user', '=', 'users.id')->select('users.*')->get();
        // $kantins = Ruko::join('Kantins', 'Kantins.id', '=', 'Rukos.id_kantin')->select('Kantins.nama_kantin')->get();
        $kantins = Kantin::all();
        // dd($kantins);
        return view('admin.ruko.dataruko', compact('data', 'kantins', 'penjuals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Kantin::all();
        return view('admin.ruko.createruko', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|min:1',
                // 'barcode' => 'image|mimes:png,jpg,jpeg|max:2048',
                'kantin' => 'required',
            ]
        );

        // //upload image
        // $image = $request->file('barcode');
        // $imageName = $image->hashName();
        // $image->storeAs('public/QRIS_Barcode', $imageName);

        // Storage::delete('public/QRIS_Barcode/' . Auth::user()->profile);

        Ruko::create([
            'id_kantin' => $request->kantin,
            'nama_ruko' => $request->name,
            // 'metode_pembayaran' => $imageName,
            'metode_pembayaran' => 'berhasil',
        ]);

        return redirect('/dataruko')->with('success', 'Data Berhasil Ditambahkan!!');
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
        $data = Ruko::where('id', $id)->first();
        $penjuals = User::join('Rukos', 'Rukos.id_user', '=', 'users.id')->select('users.*')->get();
        $kantins = Kantin::all();
        return view('admin.ruko.editruko', compact('data', 'penjuals', 'kantins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'no_telpon' => 'required',
                'kantin' => 'required',
            ]
        );

        Ruko::where('id', $id)->update([
            'id_kantin' => $request->kantin,
            'nama_ruko' => $request->name,
            'no_telpon' => $request->no_telpon,
        ]);

        return redirect('/dataruko')->with('success', 'Data Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ruko::where('id', $id)->update([
            'id_kantin' => '',
            'nama_ruko' => '',
            'no_telpon' => '',
        ]);

        return redirect('/dataruko')->with('success', 'Data Berhasil Dihapus!!');
    }
}
