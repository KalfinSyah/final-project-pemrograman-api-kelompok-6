<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashflowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cashflow_id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'updated_by' => new UserResource($this->whenLoaded('updatedBy')),
            'reservation_id' => $this->reservation_id,
            'cashflow_type' => $this->cashflow_type,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
        ];
    }
}
