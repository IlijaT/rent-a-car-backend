<?php

namespace App\Http\Resources\Car;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'id' => $this->id,
            'company_id' => $this->company_id,
            'model' => $this->model,
            'year' => $this->year,
            'price' => $this->price,
            'registration' => $this->registration,
            'consuming' => $this->consuming,
            'description' => $this->description,
            'image' => $this->imageURL,
            'available' => $this->is_rented == 0 ? 'available' : 'rented',

        ];
    }
}
