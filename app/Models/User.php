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
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'name', 'avatar', 'email','pop_id','role_id','status','verifikasi','token_verifikasi','otp',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $with = ['role','pop'];

    // Relation User Many to one Role
    public function role(){
    	return $this->belongsTo(Role::class,'role_id');
    }

    // Relation User Many to one Role
    public function pop(){
    	return $this->belongsTo(Pop::class,'pop_id');
    }

    // Relation User one to many BTS
    public function bts(){
    	return $this->hasMany(Bts::class);
    }

    // Relation User one to many BTS
    public function laporan(){
    	return $this->hasMany(Laporan::class);
    }

    // Relation User one to many BTS
    public function keluhan(){
    	return $this->hasMany(Keluhan::class);
    }

    // Relation User one to many BTS
    public function balasan(){
    	return $this->hasMany(Balasan::class);
    }

    public function RFO_Keluhan(){
    	return $this->hasMany(RFO_Keluhan::class);
    }

    public function RFO_Gangguan(){
    	return $this->hasMany(RFO_Gangguan::class);
    }

    public function notifikasi(){
    	return $this->hasMany(Notifikasi::class);
    }

    public function notifikasi_read(){
    	return $this->hasMany(Notifikasi_Read::class);
    }

    // JWT Function
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'id_user' => $this->id_user,
            'name' => $this->name,
            'verifikasi' => $this->verifikasi,
            'role_id' => $this->role_id,
            'pop_id' => $this->pop_id,
        ];
    }
}
