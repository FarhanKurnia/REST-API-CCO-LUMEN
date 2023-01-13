<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';
    protected $primaryKey = 'id_shift';
    protected $fillable = [
        'shift',
        'mulai',
        'selesai',
        'deleted_at',
    ];

    //Soft Delete
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];

    // Relation User one to many BTS
    public function laporan(){
    	return $this->hasMany(Laporan::class);
    }
}
