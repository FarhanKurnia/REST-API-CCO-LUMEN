<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balasan extends Model
{
    protected $table = 'balasans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'balasan','id_keluhan','user_id','lampiran',
    ];

    public function keluhan(){
    	return $this->belongsTo(Keluhan::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
