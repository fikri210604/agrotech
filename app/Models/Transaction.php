<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'nama_penyewa',
        'no_hp_penyewa',
        'email_penyewa',
        'alamat_penyewa',
        'jumlah_pemesanan',
        'tanggal_awal_sewa',
        'tanggal_akhir_sewa',
        'total_harga',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
