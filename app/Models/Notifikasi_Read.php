<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi_Read extends Model
{
    protected $table = 'notifikasi__reads';
    protected $primaryKey = 'id_notifikasiread';
    protected $fillable = [
        'is_read', 'notifikasi_id', 'user_id',
    ];

    public function notifikasi(){
    	return $this->belongsTo(Notifikasi::class,'notifikasi_id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
