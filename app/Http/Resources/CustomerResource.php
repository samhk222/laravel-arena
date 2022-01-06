<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'user_id'         => $this->user_id,
            'status_id'       => $this->status_id,
            'status'          => new StatusResource($this->status),
            'name'            => $this->name,
            'document'        => $this->document,
            'created_at_show' => $this->created_at->format('Y-m-d'),
        ];
    }
}
