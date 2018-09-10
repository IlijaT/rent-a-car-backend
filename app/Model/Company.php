<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function cars()
    {
        return $this->hasMany('App\Model\Car');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    protected $fillable = [
        'name', 'address', 'phone'
    ];
}
