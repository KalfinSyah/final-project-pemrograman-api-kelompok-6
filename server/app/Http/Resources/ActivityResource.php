<?php

namespace App\Http\Resources;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'activity_id' => $this->id,
            'reservation_id' => $this->reservation_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'updated_by' => new UserResource($this->whenLoaded('updatedBy')),
            'activity_type' => $this->activity_type,
            'activity_name' => $this->activity_name,
            'activity_date' => $this->activity_date,
            'activity_desc' => $this->activity_desc,
            'activity_status' => $this->activity_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
