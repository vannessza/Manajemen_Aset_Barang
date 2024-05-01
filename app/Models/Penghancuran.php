<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghancuran extends Model
{
    use HasFactory;
    protected $table = "penghancuran";
    protected $fillable = ['aset_id', 'nama_aset_id', 'tipePemusnahan', 'tglPemusnahan', 'pengesahan', 'pemohon', 'status', 'keterangan', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'pemohon');
    }
    public function aset(){
        return $this->belongsTo(Aset::class);
    }
    public function AsetDetail(){
        return $this->belongsTo(AsetDetail::class, 'nama_aset_id');
    }
}
