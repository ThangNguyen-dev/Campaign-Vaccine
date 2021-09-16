<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Campaign_ticketRS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->getDescription()['description'] ? $this->getDescription()['description'] : null,
                'cost' => $this->cost,
                'available' => $this->getDescription()['available'],
            ];
    }
}
