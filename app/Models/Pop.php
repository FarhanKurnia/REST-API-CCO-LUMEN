<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pop extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'pops';
    protected $primaryKey = 'id_pop';
    protected $fillable = [
        'id_pop',
        'pop',
        'deleted_at',
    ];

    
    protected $hidden = [
        'created_at','updated_at','deleted_at',
    ];
    

    // Relation POP one to many User
    public function user(){
    	return $this->hasMany(User::class);
    }

    // Relation POP one to many BTS
    public function bts(){
    	return $this->hasMany(Bts::class);
    }

    // Relation POP one to many User
    public function keluhan(){
    	return $this->hasMany(Keluhan::class);
    }

    // Relation User one to many BTS
    public function laporan(){
        return $this->hasMany(Laporan::class);
    }

    public function notifikasi(){
    	return $this->hasMany(Notifikasi::class);
    }
}
