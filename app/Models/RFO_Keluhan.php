<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RFO_Keluhan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'r_f_o__keluhans';
    protected $primaryKey = 'id_rfo_keluhan';
    protected $fillable = [
        'nomor_tiket', 'mulai_keluhan', 'selesai_keluhan', 'problem', 'action', 'status','deskripsi', 'lampiran_rfo_keluhan', 'user_id', 'keluhan_id',
    ];

    public function keluhan(){
    	return $this->belongsTo(Keluhan::class, 'keluhan_id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
