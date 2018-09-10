<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'href' => [
                'cars' => route('company.getCars',  $this->id )
            ],
        ];
    }
}
