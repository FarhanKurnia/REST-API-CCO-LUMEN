<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    protected $table = 'balasans';
    protected $primaryKey = 'id_balasan';
    protected $fillable = [
        'balasan','keluhan_id','user_id','lampiran',
    ];

    public function keluhan(){
    	return $this->belongsTo(Keluhan::class,'keluhan_id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
