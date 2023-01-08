<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'roles';
    protected $primaryKey = 'id_role';
    protected $fillable = [
        'id_role',
        'role',
    ];
    
    //Soft Delete
    protected $hidden = [
        'delated_at',
    ];



    // Relation Role one to many User
    public function user(){
    	return $this->hasMany(User::class);
    }
}
