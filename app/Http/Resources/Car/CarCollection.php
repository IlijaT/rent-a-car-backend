<?php

namespace App\Http\Resources\Car;

use Illuminate\Http\Resources\Json\JsonResource;

class CarCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "model" => $this->model,
            "year" => $this->year,
            'description' => $this->description,
            'consuming' => $this->consuming,
            'registration' => $this->registration,
            "available" => $this->is_rented == 0 ? 'available' : 'rented',
            'image' => $this->imageURL,
            'company_id' => $this->company_id,

        ];
    }
}
