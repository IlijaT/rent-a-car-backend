<?php

namespace App\Http\Controllers;

use App\Model\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\Car\CarCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Company\CompanyResource;
use App\Http\Resources\Company\CompanyCollection;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'getCars']]);
        $this->middleware('admin:api')->only(['destroy','store']);
        $this->middleware('owner:api')->only('update');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanyResource::collection(Company::all());
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
    public function store(CompanyRequest $request)
    {
        $newCompany = new Company($request->all());
        $newCompany->save();
        return $newCompany;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getCars(Company $company)
    {
        $cars = $company->cars;
        return CarCollection::collection($cars);
    }

   
}
