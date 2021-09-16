<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionRS extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'vaccinator' => $this->vaccinator,
            'start' => $this->start,
            'end' => $this->end,
            'type' => $this->type,
            'cost' => $this->cost ? $this->cost : null,
        ];
    }
}
