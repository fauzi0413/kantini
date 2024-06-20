<?php

namespace App\Http\Controllers;

use App\Models\Ruko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

    function dataakun_user()
    {
        $data = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        $status = 'User';
        return view('admin.akun.dataakun', compact('data', 'status'));
    }

    function dataakun_penjual()
    {
        $data = User::where('role', 'penjual')->orderBy('created_at', 'desc')->get();
        $status = 'Penjual';
        return view('admin.akun.dataakun', compact('data', 'status'));
    }

    function dataakun_admin()
    {
        $data = User::where('role', 'admin')->orderBy('created_at', 'desc')->get();
        $status = 'Admin';
        return view('admin.akun.dataakun', compact('data', 'status'));
    }

    function verifikasiakun($id)
    {
        $data = User::find($id);
        $data->update([
            'email_verified_at' => Carbon::now(),
        ]);

        if ($data->role == 'penjual') {
            Ruko::create([
                'id_user' => $data->id,
                'id_kantin' => '',
                'nama_ruko' => '',
                'metode_pembayaran' => '',
                'no_telpon' => '',
            ]);
        }

        $status = $data->role;
        if ($status == 'user') {
            return redirect('/dataakun/user')->with('success', 'Data Berhasil Diverifikasi!!');
        } elseif ($status == 'admin') {
            return redirect('/dataakun/admin')->with('success', 'Data Berhasil Diverifikasi!!');
        } elseif ($status == 'penjual') {
            return redirect('/dataakun/penjual')->with('success', 'Data Berhasil Diverifikasi!!');
        }
    }
}
