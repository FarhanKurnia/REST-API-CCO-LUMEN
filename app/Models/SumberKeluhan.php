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
        'deleted_at',
    ];

    //Soft Delete
    protected $hidden = [
        'created_at','deleted_at'
    ];    

    public function keluhan(){
    	return $this->hasMany(Keluhan::class,'id_keluhan');
    }
}
