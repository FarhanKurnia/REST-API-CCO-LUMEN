<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberKeluhan extends Model
{
    protected $table = 'sumber_keluhans';
    protected $primaryKey = 'id_sumber';
    protected $fillable = [
        'id_sumber',
        'sumber',
    ];

    //Soft Delete
    protected $hidden = [
        'delated_at','created_at','deleted_at'
    ];    

    public function keluhan(){
    	return $this->hasMany(Keluhan::class,'id_keluhan');
    }
}
