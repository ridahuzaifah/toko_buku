<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alamat extends Model
{
    protected $table = 'alamats';

    protected $fillable = [
        'user_id',
        'nama_penerima',
        'no_hp',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'kode_pos',
        'catatan',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class);
    }
}
