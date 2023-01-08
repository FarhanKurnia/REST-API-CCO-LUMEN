<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $table = 'keluhans';
    protected $primaryKey = 'id_keluhan';
    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'kategori_pelanggan',
        'nama_pelapor',
        'nomor_pelapor',
        'nomor_keluhan',
        'sumber_id',
        'detail_sumber',
        'keluhan',
        'status',
        'lampiran',
        'pop_id',
        'user_id',
        'sentimen_analisis',
        'rfo_gangguan_id',
        'rfo_keluhan_id',
    ];

    protected $with = ['sumber'];
    //Soft Delete
    protected $hidden = [
        'delated_at',
    ];

    // Relation Balasan
    public function balasan(){
        return $this->hasMany(Balasan::class,'keluhan_id');
    }

    public function lampirankeluhan(){
        return $this->hasMany(Lampiran_Keluhan::class,'keluhan_id');
    }

    // Relation User
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }

    // Relation User
    public function sumber(){
    	return $this->belongsTo(SumberKeluhan::class,'sumber_id');
    }

    // Relation POP
    public function pop(){
    	return $this->belongsTo(Pop::class, 'pop_id');
    }

    // Relation RFO Keluhan
    public function RFO_Keluhan(){
    	return $this->belongsTo(RFO_Keluhan::class, 'rfo_keluhan_id');
    }

    // Relation RFO Gangguan
    public function RFO_Gangguan(){
    	return $this->belongsTo(RFO_Gangguan::class, 'rfo_gangguan_id');
    }

    public function notifikasi(){
    	return $this->hasMany(Notifikasi::class,'keluhan_id');
    }
}
