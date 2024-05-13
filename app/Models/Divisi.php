<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = "divisi";

    protected $fillable = ['kodeDivisi', 'namaDivisi'];

    public function userProfile()
    {
        return $this->hasMany(UserProfile::class);
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
}
