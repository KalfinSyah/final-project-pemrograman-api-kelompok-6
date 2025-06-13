<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivitySimplifiedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'activity_type' => $this->activity_type,
            'activity_date' => $this->activity_date,
            'activity_desc' => $this->activity_desc,
        ];
    }
}
