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
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_bts', 'nama_pic', 'nomor_pic', 'lokasi', 'kordinat', 'pop_id', 'user_id',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    // Relation User Many to one BTS
    public function user(){
    	return $this->belongsTo(User::class);
    }

    // Relation User Many to one BTS
    public function pop(){
    	return $this->belongsTo(Pop::class);
    }
}
