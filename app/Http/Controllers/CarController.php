<?php

namespace App\Http\Controllers;

use App\Model\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Car\CarResource;
use Illuminate\Support\Facades\Storage;
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
        //Log::info($request->except(['image']));

         // Handle File Upload

         if ($request->hasFile('image')) {
             // Get the Filename with Extension
             $fileNameWithExt = $request->file('image')->getClientOriginalName();
             // Get the filename
             $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
             // Get the extension
             $extension = $request->file('image')->getClientOriginalExtension();
             //Filename to store
             $fileNameToStore = $filename.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);

            } else {
             $fileNameToStore = "noimage.jpg";
         }
         
        
        $newCar = new Car($request->except(['image']));
        $newCar->imageURL = $fileNameToStore;
        $newCar->price = $request->price;
        $newCar->save();
        return new CarResource($newCar);

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
         // Handle File Upload

        if ($request->hasFile('image')) {
            // Get the Filename with Extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // Get the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

           $path = $request->file('image')->storeAs('public/images', $fileNameToStore);

        }
       
        $car->update($request->except(['image']));
        if($request->hasFile('image')) {
            $car->imageURL = $fileNameToStore;
        }
        $car->price = $request->price;
        
        $car->save();
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
        if($car->imageURL != 'noimage.jpg' ) {
            Storage::delete('public/images/'.$car->imageURL);
        }

        $car->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
