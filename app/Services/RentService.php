<?php

namespace App\Services;

use App\Model\Car;
use App\Model\Rent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RentService
{
    public function rentCar(Request $request){
         
        $rent = new Rent($request->all());
        $rent->save();
        return $rent;

    }
}