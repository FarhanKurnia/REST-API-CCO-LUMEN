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

    protected $with = ['user'];

    public function keluhan(){
    	return $this->belongsTo(Keluhan::class,'keluhan_id');
    }

    // Relation User Many to one BTS
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
