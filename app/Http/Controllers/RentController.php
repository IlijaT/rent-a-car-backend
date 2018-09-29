<?php

namespace App\Http\Controllers;

use App\Model\Car;
use Carbon\Carbon;
use App\Model\Rent;
use Illuminate\Http\Request;
use App\Services\RentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Rent\RentResource;
use App\Http\Resources\Rent\RentCollection;
use Symfony\Component\HttpFoundation\Response;

class RentController extends Controller
{
    protected $rentService;

    public function __construct(RentService $rentService)
    {   
        $this->rentService = $rentService;
        $this->middleware('auth:api');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        // Log::info($request);
        $rent = $this->rentService->rentCar($request);
        
        if(!$rent){
            return response(null, Response::HTTP_BAD_REQUEST);
        } else {
            return $rent;
        }

       
    }

    public function nextRentStart($car_id, $date)
    {
        $rent = Rent::where('start', '>', $date)
                ->where('car_id', $car_id)
                ->first();

        if($rent) {
            $rentString= $rent->start;
            $stringDate = explode(" ", $rentString);
            $rentDay = Carbon::createFromFormat('Y-m-d', $stringDate[0]);
            $previous = $rentDay->subDays(1);
            return $previous;
        } else {
            $rentDay = Carbon::createFromFormat('Y-m-d', $date);
            $oneMontLater = $rentDay->addDays(30);
            return $oneMontLater;
        }
         
      
    }

    public function showCarRents($id)
    {
        $carRents = Rent::where('car_id', $id)->get();
        return RentResource::collection($carRents);
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        //
    }
}
