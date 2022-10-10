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
        'nama_pelapor',
        'nomor_pelapor',
        'nomor_keluhan',
        'source',
        'email',
        'sosmed',
        'keluhan',
        'status',
        'lampiran',
        'pop_id',
        'user_id',
    ];

    // Relation Balasan
    public function balasan(){
        return $this->hasMany(Balasan::class,'keluhan_id');
    }

    // Relation User
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }

    // Relation POP
    public function pop(){
    	return $this->belongsTo(Pop::class, 'pop_id');
    }

    // Relation RFO
    public function RFO_Keluhan(){
    	return $this->hasOne(RFO_Keluhan::class);
    }
}
