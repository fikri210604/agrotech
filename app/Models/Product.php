<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'id',
        'nama',
        'kategori',
        'merek',
        'jenis',
        'deskripsi',
        'stok',
        'harga_sewa',
        'status',
        'foto',
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
