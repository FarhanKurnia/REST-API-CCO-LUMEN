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
        'deleted_at',
    ];

    //Soft Delete
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];


    // Relation Role one to many User
    public function user(){
    	return $this->hasMany(User::class);
    }
}
