<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghancuran extends Model
{
    use HasFactory;
    protected $table = "penghancuran";
    protected $fillable = ['aset_id', 'nama_aset', 'tipePemusnahan', 'tglPemusnahan', 'pengesahan', 'pemohon', 'status', 'keterangan', 'image'];

    public function userpemohon()
    {
        return $this->belongsTo(User::class, 'pemohon');
    }

    public function userpengesahan()
    {
        return $this->belongsTo(User::class, 'pengesahan');
    }
    public function aset(){
        return $this->belongsTo(Aset::class);
    }
    public function AsetDetail(){
        return $this->belongsTo(AsetDetail::class);
    }
}
