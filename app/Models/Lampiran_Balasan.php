<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampiran_Balasan extends Model
{
    protected $table = 'lampiran__balasans';
    protected $primaryKey = 'id_lampiran_balasan';
    protected $fillable = [
        'path','balasan_id',
    ];

    public function balasan(){
    	return $this->belongsTo(Balasan::class,'balasan_id');
    }
}
