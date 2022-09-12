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
    protected $primaryKey = 'id';
    protected $fillable = [
        'role',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    // Relation Role one to many User
    public function users(){
    	return $this->hasMany(User::class, 'foreign_key');
        return $this->hasMany(User::class, 'foreign_key','local_key');
    }
}
