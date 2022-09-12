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
    protected $primaryKey = 'id';
    protected $fillable = [
        'pop',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    // Relation POP one to many User
    public function users(){
    	return $this->hasMany(User::class);
    }
}
