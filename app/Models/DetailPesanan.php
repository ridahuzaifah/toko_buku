<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanans';

    protected $fillable = [
        'pesanan_id',
        'buku_id',
        'kode_buku',
        'judul_buku',
        'pengarang',
        'penerbit',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class)->withTrashed();
    }
}
