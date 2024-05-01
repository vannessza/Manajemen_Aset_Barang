<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjaman";
    protected $fillable = ['user_id', 'aset_id', 'nama_aset_id', 'kodePeminjaman', 'tglPeminjaman', 'status', 'lokasi_id', 'keterangan', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function aset(){
        return $this->belongsTo(Aset::class, 'aset_id');
    }
    public function AsetDetail(){
        return $this->belongsTo(AsetDetail::class, 'nama_aset_id');
    }
    public function pengembalian(){
        return $this->hasMany(Pengembalian::class);
    }
}
