<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'deskripsi',
        'visi',
        'misi',                 
        'alasan_memilih',
        'foto_promosi',
        'foto_galeri',
    ];

    protected $cast = [
        'foto' => 'array'
    ];

}
