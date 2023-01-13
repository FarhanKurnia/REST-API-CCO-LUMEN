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
        'nomor_rfo_keluhan','nomor_tiket', 'mulai_keluhan', 'selesai_keluhan', 'problem', 'action','deskripsi','durasi', 'user_id',        'deleted_at',
    ];
    

    // Soft Delete
    protected $hidden = [
        'deleted_at',
    ];

        
    public function keluhan(){
        return $this->hasOne(Keluhan::class,'rfo_keluhan_id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
