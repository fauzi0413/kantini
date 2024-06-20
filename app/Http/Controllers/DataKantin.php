<?php

namespace App\Http\Controllers;

use App\Models\Kantin;
use App\Models\Ruko;
use Illuminate\Http\Request;

class DataKantin extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kantin::all();
        $ruko = Ruko::all();
        return view('admin.kantin.datakantin', compact('data', 'ruko'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kantin.createkantin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
            ]
        );

        Kantin::create([
            'nama_kantin' => $request->name,
        ]);

        return redirect('/datakantin')->with('success', 'Data Berhasil Ditambahkan!!');
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
        $data = Kantin::where('id', $id)->first();
        return view('admin.kantin.editkantin', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
            ]
        );

        Kantin::where('id', $id)->update([
            'nama_kantin' => $request->name,
        ]);

        return redirect('/datakantin')->with('success', 'Data Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cek = Ruko::where('id_kantin', $id)->first();
        if ($cek) {
            return redirect('/datakantin')->with('danger', 'Data tidak dapat dihapus!!');
        } else {
            dd($cek);
            $data = Kantin::find($id);
            $data->delete();
        }
        return redirect('/datakantin')->with('success', 'Data Berhasil Dihapus!!');
    }
}
