<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $primaryKey = 'id_notifikasi';
    protected $fillable = [
        'judul', 'detail', 'user_id_notif','pop_id', 'url', 
    ];

    public function notifikasi_read(){
    	return $this->hasMany(Notifikasi_Read::class,'notifikasi_id');
    }

    public function pop(){
    	return $this->belongsto(POP::class,'pop_id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id_notif');
    }

}