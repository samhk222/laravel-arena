<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'customer_id'     => $this->customer_id,
            'customer'        => new CustomerResource($this->customer),
            'status_id'       => $this->status_id,
            'status'          => new StatusResource($this->status),
            'number'          => $this->number,
            'created_at_show' => $this->created_at->format('Y-m-d'),
        ];
    }
}
