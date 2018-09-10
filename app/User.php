<?php

namespace App;

use App\Role;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function company()
    {
        return $this->belongsTo('App\Model\Company');
    }

    public function rents()
    {
        return $this->hasMany('App\Model\Rent');
    }

    public function hasAnyRoles($roles)
    {
        foreach ($roles as $key => $value) {
            return $this->hasRole($value);
        }
        return false;
    }
  
    public function hasRole($role)
    {
        if ($this->role()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_id', 'role_id' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
