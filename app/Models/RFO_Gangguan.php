<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RFO_Gangguan extends Model
{
    protected $table = 'r_f_o_gangguans';
    protected $primaryKey = 'id_rfo_gangguan';
    protected $fillable = [
        'nomor_rfo_gangguan',
        'problem',
        'action',
        'deskripsi',
        'status',
        'mulai_gangguan',
        'selesai_gangguan',
        'nomor_tiket',
        'durasi',
        'lampiran_rfo_gangguan',
        'user_id',
    ];

    public function keluhan(){
    	return $this->hasMany(Keluhan::class,'rfo_gangguan_id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
