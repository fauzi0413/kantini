<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_ruko',
        'id_transaksi',
        'produk',
        'jumlah',
        'status',
        'catatan',
    ];

    static function tambah_pesanan($id_user, $id_ruko, $id_transaksi, $produk, $jumlah, $catatan)
    {
        Pesanan::create([
            'id_user' => $id_user,
            'id_ruko' => $id_ruko,
            'id_transaksi' => $id_transaksi,
            'produk' => $produk,
            'jumlah' => $jumlah,
            'catatan' => $catatan,
            'status' => 'Dipesan',
        ]);
    }
}
