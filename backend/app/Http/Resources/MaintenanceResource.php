<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MaintenanceResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'car_id'        => $this->car_id,
            'type'          => $this->type,
            'description'   => $this->description,
            'start_date'    => Carbon::createFromFormat('Y-m-d', $this->start_date)->format('d/m/Y'),
            'end_date'      => Carbon::createFromFormat('Y-m-d', $this->end_date)->format('d/m/Y')
        ];
    }
}
