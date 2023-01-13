<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bts extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'bts';
    protected $primaryKey = 'id_bts';
    protected $fillable = [
        'nama_bts', 'nama_pic', 'nomor_pic', 'lokasi', 'kordinat', 'pop_id', 'user_id','deskripsi','deleted_at',
    ];

    
    //Soft Delete
    protected $hidden = [
        'deleted_at','created_at','updated_at','user_id'
    ];


    // Relation User Many to one BTS
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }

    // Relation User Many to one BTS
    public function pop(){
    	return $this->belongsTo(Pop::class,'pop_id');
    }
}
