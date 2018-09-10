<?php

namespace App\Http\Controllers;

use App\Model\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Car\CarResource;
use App\Http\Resources\Car\CarCollection;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
        $this->middleware('worker:api', ['except' => ['index', 'show']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarCollection::collection(Car::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        // Log::info($request);
        // log::info("da vidimo da li postoji user");
        // log::info(Auth::user());
        // log::info("pokusavam logujem role od usera");
        // log::info($request->user()->role);
        
        $newCar = new Car($request->all());
        $newCar->save();
        return $newCar;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //return $car;
        return new CarResource($car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $car->update($request->all());
        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
