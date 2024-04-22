<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetDetail extends Model
{
    use HasFactory;
    protected $table = "aset_detail";
    protected $fillable = ['aset_id', 'namaAset', 'detailAset', 'jenisAset', 'klasifikasiAset', 'masaRetensi', 'tglPembelian', 'jumlah', 'image', 'status'];

    public function Aset()
    {
        return $this->belongsTo(Aset::class);
    }
    public function History(){
        return $this->hasMany(History::class);
    }
    public function Peminjaman(){
        return $this->hasMany(Peminjaman::class);
    }
}
