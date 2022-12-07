<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $primaryKey = 'id_notifikasi';
    protected $fillable = [
        'judul', 'detail', 'user_id_notif', 'url', 
    ];

    public function notifikasi_read(){
    	return $this->hasMany(Notifikasi_Read::class,'notifikasi_id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }

}