<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = "user_profile";
    protected $fillable = ['user_id','divisi_id','alamat','noTelp','image'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function divisi(){
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
