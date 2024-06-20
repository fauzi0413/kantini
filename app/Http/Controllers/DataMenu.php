<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Ruko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataMenu extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Menu::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('penjual.menu.datamenu', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjual.menu.createmenu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required',
                'gambar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            ]
        );

        //upload image
        $image = $request->file('gambar');
        $imageName = $image->hashName();
        $image->storeAs('public/menu', $imageName);

        Menu::create([
            'id_user' => Auth::user()->id,
            'nama_menu' => $request->name,
            'harga_menu' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar_menu' => $imageName,
        ]);

        return redirect('/datamenu')->with('success', 'Data Berhasil Ditambahkan!!');
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
        $data = Menu::find($id);
        return view('penjual.menu.editmenu', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required',
                'gambar' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]
        );

        //upload image
        if ($request->gambar) {
            $data = Menu::findOrFail($id);
            $image = $request->file('gambar');
            $imageName = $image->hashName();
            $image->storeAs('public/menu', $imageName);
            Storage::delete('public/menu/' . $data->gambar_menu);

            $data->update([
                'nama_menu' => $request->name,
                'harga_menu' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'gambar_menu' => $imageName,
            ]);
        } else {
            $data = Menu::find($id);
            $data->update([
                'nama_menu' => $request->name,
                'harga_menu' => $request->harga,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        return redirect('/datamenu')->with('success', 'Data Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Menu::find($id);
        Storage::delete('public/menu/' . $data->gambar_menu);
        $data->delete();
        return redirect('/datamenu')->with('success', 'Data Berhasil Dihapus!!');
    }
}
