<?php

namespace App\Http\Controllers;

use App\Models\Kantin;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Ruko;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{

    public function index()
    {
        $kantin = Kantin::all();
        $ruko = Ruko::all();
        $menu = Menu::groupBy('id_user')->get();
        return view('pembeli.index', compact('kantin', 'ruko', 'menu'));
    }

    public function kantin($id)
    {
        $ruko = Ruko::where('id', $id)->first();
        $data = Menu::where('id_user', $ruko->id_user)->get();
        $cart = session("cart");
        return view('pembeli.kantin', compact('data', 'ruko'))->with("cart", $cart);
    }

    public function beli($id)
    {
        $cart = session("cart");
        $menu = Menu::where('id', $id)->first();
        $ruko = Ruko::where('id_user', $menu->id_user)->first();
        $cart[$id] = [
            'nama_produk' => $menu->nama_menu,
            'harga_produk' => $menu->harga_menu,
            'ruko' => $ruko->id,
            'catatan' => '',
            'jumlah' => 1,
        ];

        session(["cart" => $cart]);
        return redirect("/kantin/$ruko->id");
    }

    public function hapus($id)
    {
        $cart = session("cart");
        $menu = Menu::where('id', $id)->first();
        $ruko = Ruko::where('id_user', $menu->id_user)->first();
        unset($cart[$id]);
        session(["cart" => $cart]);
        return redirect("/kantin/$ruko->id");
    }

    public function tambah_transaksi(Request $request)
    {
        $cart = session("cart");
        $catatan_transaksi = $request->catatan_transaksi;
        $grandtotal = 0;
        foreach ($cart as $ct => $val) {
            $subtotal = $val["harga_produk"] * $val["jumlah"];
            $grandtotal += $subtotal;
            // $catatan_transaksi = $catatan;
        }
        $id_transaksi = Transaksi::transaksi($grandtotal, $catatan_transaksi);

        foreach ($cart as $ct => $val) {
            $id_user = Auth::user()->id;
            $id_ruko = $val["ruko"];
            $produk = $val["nama_produk"];
            $jumlah = $val["jumlah"];
            $catatan_pesanan = $val["catatan"];
            Pesanan::tambah_pesanan($id_user, $id_ruko, $id_transaksi, $produk, $jumlah, $catatan_pesanan);
        };

        session()->forget("cart");
        return redirect('/')->with('success', 'Pesanan Berhasil Dibuat!!');
    }

    public function riwayat_pesanan()
    {
        $user = User::all();
        $ruko = Ruko::all();
        $menu = Menu::all();
        $data = Pesanan::orderBy('id', 'DESC')->get();
        return view('pembeli.datapesanan', compact('data', 'ruko', 'user', 'menu'));
    }

    public function status($status,  $id)
    {
        $data = Pesanan::where('id', $id);
        $data->update([
            'status' => $status,
        ]);
        return redirect('/riwayat-pesanan')->with('success', 'Status Berhasil Diubah');
    }

    public function tambah(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $id = $request->id;
            $menu = Menu::where('id', $id)->first();
            $ruko = Ruko::where('id_user', $menu->id_user)->first();
            $cart[$request->id]["jumlah"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect("/kantin/$ruko->id");
        }
    }

    public function tambah_catatan(Request $request)
    {
        if ($request->id and $request->catatan_pesanan) {
            $cart = session()->get('cart');
            $id = $request->id;
            $menu = Menu::where('id', $id)->first();
            $ruko = Ruko::where('id_user', $menu->id_user)->first();
            $cart[$request->id]["catatan"] = $request->catatan_pesanan;
            session()->put('cart', $cart);
            return redirect("/kantin/$ruko->id");
        }
    }
}
