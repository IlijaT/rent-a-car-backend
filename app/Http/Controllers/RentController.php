<?php

namespace App\Http\Controllers;

use App\Model\Car;
use App\Model\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\RentService;
use Symfony\Component\HttpFoundation\Response;

class RentController extends Controller
{
    protected $rentService;

    public function __construct(RentService $rentService)
    {   
        $this->rentService = $rentService;
        $this->middleware('auth:api');
        $this->middleware('rent:api')->only('store');
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
    public function store(Car $car)
    {
    
        $rent = $this->rentService->rentCar($car);
       if(!$rent){
            return response(null, Response::HTTP_BAD_REQUEST);
       }

       return $rent;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
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
