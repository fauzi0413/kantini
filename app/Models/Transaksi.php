<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'total_harga',
        'metode_pembayaran',
        'catatan',
    ];

    static function transaksi($grandtotal, $catatan_transaksi)
    {
        $data = Transaksi::create([
            'id_user' => Auth::user()->id,
            'total_harga' => $grandtotal,
            'metode_pembayaran' => 'cash',
            'catatan' => $catatan_transaksi,
        ]);

        return $data->id;
    }
}
