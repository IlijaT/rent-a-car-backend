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
            'model' => $this->model,
            'year' => $this->year,
            'registration' => $this->registration,
            'consuming' => $this->consuming,
            'description' => $this->description,
            'imageURL' => $this->imageURL,
            'available' => $this->is_rented == 0 ? 'available' : 'rented',

        ];
    }
}
