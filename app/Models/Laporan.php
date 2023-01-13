<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'nomor_laporan',
        'tanggal',
        'shift_id',
        'pop_id',
        'user_id',
        'noc',
        'helpdesk',
        'lampiran_laporan',
        'deleted_at',
    ];
    
    //Soft Delete
    protected $hidden = [
        'deleted_at',
    ];
    
     // Relation User Many to one BTS
    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }

    public function pop(){
    	return $this->belongsTo(POP::class,'pop_id');
    }

    public function shift(){
    	return $this->belongsTo(Shift::class,'shift_id');
    }
}
