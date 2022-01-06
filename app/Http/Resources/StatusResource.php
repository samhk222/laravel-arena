<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
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
            'id'          => $this->id,
            'description' => $this->description,
            'color'       => $this->color,
            'badge'       => sprintf('<small class="badge badge-%s">%s</small>', $this->color, $this->description),
        ];
    }
}
