<?php
namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject{
    use Authenticatable, Authorizable, HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email','pop_id','role_id'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // Relation User Many to one Role
    public function role(){
    	return $this->belongsTo(Role::class);
    }

    // Relation User Many to one Role
    public function pop(){
    	return $this->belongsTo(Pop::class);
    }

    // Relation User one to many BTS
    public function bts(){
    	return $this->hasMany(Bts::class);
    }

    // Relation User one to many BTS
    public function keluhan(){
    	return $this->hasMany(Keluhan::class);
    }

    // Relation User one to many BTS
    public function balasan(){
    	return $this->hasMany(Balasan::class);
    }

    // JWT Function
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role_id' => $this->role_id,
        ];
    }
}
