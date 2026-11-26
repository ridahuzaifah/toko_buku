<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    'kode_buku',
    'judul_buku',
    'pengarang',
    'penerbit',
    'tahun_terbit',
    'stok',
    'harga_beli',
    'harga_jual',
    'keterangan',
    ];
}