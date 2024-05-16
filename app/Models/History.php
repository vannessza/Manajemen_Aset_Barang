<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = "history";

    protected $fillable = ['user_id', 'aset_detail_id', 'action', 'keterangan'];

    public function asetDetail()
    {
        return $this->belongsTo(AsetDetail::class, 'aset_detail_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
