<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $table = "aset";
    protected $fillable = ['kodeAset', 'namaAset', 'detailAset', 'jenisAset', 'klasifikasiAset', 'ciaLevel', 'asetValuation', 'nilaiRisiko', 'masaRetensi'];
    public function AsetDetail()
    {
        return $this->hasMany(AsetDetail::class);
    }
    public function Peminjaman(){
        return $this->hasMany(Peminjaman::class);
    }
    public function Pengembalian(){
        return $this->hasMany(Pengembalian::class);
    }
}
