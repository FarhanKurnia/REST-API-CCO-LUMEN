<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampiran_Keluhan extends Model
{
    protected $table = 'lampiran__keluhans';
    protected $primaryKey = 'id_lampiran_keluhan';
    protected $fillable = [
        'path','keluhan_id',
    ];

    public function keluhan(){
    	return $this->belongsTo(Keluhan::class,'keluhan_id');
    }
}
