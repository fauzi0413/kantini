<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nama_menu',
        'harga_menu',
        'deskripsi',
        'gambar_menu',
    ];
}
