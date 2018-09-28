<?php

namespace App\Http\Controllers;

use App\Model\Car;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
      
    }

    public function showCarRents($id)
    {
        $carRents = Rent::where('car_id', $id)->get();
        return RentResource::collection($carRents);
        // return $carRents;
      
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
