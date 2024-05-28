<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = "lokasi";
    protected $fillable = ['kodeLokasi', 'alamat'];

    public function Peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function Pengembalian()
    {
        return $this->hasMany(Pengembalian::class);
    }
}
