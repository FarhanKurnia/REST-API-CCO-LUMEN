<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'keluhans';
    protected $primaryKey = 'id_keluhan';
    protected $fillable = [
        'id_pelanggan', 'nama_pelanggan', 'nama_pelapor', 'nomor_pelapor', 'nomor_keluhan', 'keluhan', 'status', 'status', 'lampiran', 'pop_id', 'user_id',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    // Relation User Many to one User
    public function user(){
    	return $this->belongsTo(User::class);
    }

    // Relation User Many to one POP
    public function pop(){
    	return $this->belongsTo(Pop::class);
    }

     // Relation User one to many BTS
     public function balasan(){
    	return $this->hasMany(Balasan::class);
    }
}
