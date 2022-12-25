<?php

namespace App\Http\Resources;

use App\Models\Maintenance;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'user_id'       => $this->user_id,
            'name'          => $this->name,
            'brand'         => $this->brand,
            'model'         => $this->model,
            'version'       => $this->version,
            'maintenance'   => MaintenanceResource::collection($this->maintenances)
        ];
    }
}
