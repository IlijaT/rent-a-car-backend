<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'user_id', 'car_id', 'start', 'end', 'total_price'
    ];
}
