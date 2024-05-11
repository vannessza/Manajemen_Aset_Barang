<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = "pengembalian";
    protected $fillable = ['user_id', 'aset_id', 'nama_aset_id', 'kodePengembalian', 'tglPengembalian', 'status', 'lokasi_id', 'keterangan', 'image'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function aset(){
        return $this->belongsTo(Aset::class);
    }
    public function AsetDetail(){
        return $this->belongsTo(AsetDetail::class, 'nama_aset_id');
    }
    public function pengembalian(){
        return $this->belongsTo(AsetDetail::class, 'nama_aset_id');
    }
    public function lokasi(){
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }
}
