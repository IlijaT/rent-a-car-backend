<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Model\Company');
    }

    public function rents()
    {
        return $this->hasMany('App\Model\Rent');
    }

    protected $fillable = [
        'model', 'year', 'consuming', 'registration', 'company_id', 'description', 'is_rented'
    ];
}
