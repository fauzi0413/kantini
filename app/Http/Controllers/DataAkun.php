<?php

namespace App\Http\Controllers;

use App\Models\Ruko;
use App\Models\User;
use Illuminate\Http\Request;

class DataAkun extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('created_at', 'desc')->get();
        $status = '';
        return view('admin.akun.dataakun', compact('data', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = '';
        return view('admin.akun.createakun', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users|',
                'password' => 'required|min:5|confirmed',
                'role' => 'required',
            ]
        );

        // $validatedData['password'] = bcrypt($validatedData['password']);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        $status = $request->role;
        if ($status == 'user') {
            return redirect('/dataakun/user')->with('success', 'Data Berhasil Ditambahkan!!');
        } elseif ($status == 'admin') {
            return redirect('/dataakun/admin')->with('success', 'Data Berhasil Ditambahkan!!');
        } elseif ($status == 'penjual') {
            return redirect('/dataakun/penjual')->with('success', 'Data Berhasil Ditambahkan!!');
        }
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
        $data = User::where('id', $id)->first();
        $status = $data->role;
        return view('admin.akun.editakun', compact('data', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|min:1',
                'role' => 'required',
            ]
        );

        $role = $request->role;
        if ($role == 'penjual') {
            $cek = Ruko::where('id_user', $id)->first();
            if ($cek == null) {
                Ruko::create([
                    'id_user' => $id,
                    'id_kantin' => '',
                    'nama_ruko' => '',
                    'metode_pembayaran' => '',
                    'no_telpon' => '',
                ]);
            }
        } else {
            $cek = Ruko::where('id_user', $id)->first();
            if ($cek) {
                $data2 = Ruko::where('id_user', $id);
                $data2->delete();
            }
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        $status = $request->role;
        if ($status == 'user') {
            return redirect('/dataakun/user')->with('success', 'Data Berhasil Diubah!!');
        } elseif ($status == 'admin') {
            return redirect('/dataakun/admin')->with('success', 'Data Berhasil Diubah!!');
        } elseif ($status == 'penjual') {
            return redirect('/dataakun/penjual')->with('success', 'Data Berhasil Diubah!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();
        $data2 = Ruko::where('id_user', $id);
        $data2->delete();

        $status = $data->role;
        if ($status == 'user') {
            return redirect('/dataakun/user')->with('success', 'Data Berhasil Dihapus!!');
        } elseif ($status == 'admin') {
            return redirect('/dataakun/admin')->with('success', 'Data Berhasil Dihapus!!');
        } elseif ($status == 'penjual') {
            return redirect('/dataakun/penjual')->with('success', 'Data Berhasil Dihapus!!');
        }
    }
}
