<?php

namespace App\Services;

use App\Model\Car;
use App\Model\Rent;
use Illuminate\Support\Facades\Auth;

class RentService
{
    public function rentCar(Car $car){
        if($car->is_rented){
            return;
        }

        $rent = new Rent();
        $rent->user_id = Auth::user()->id;
        $rent->car_id = $car->id;
        $rent->save();

        $car->is_rented = true;
        $car->save();

        return $rent;

    }
}