<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruko extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_kantin',
        'nama_ruko',
        'no_telpon',
        'metode_pembayaran',
    ];
}
