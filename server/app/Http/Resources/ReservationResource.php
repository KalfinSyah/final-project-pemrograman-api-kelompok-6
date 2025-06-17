<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reservation_id' => $this->id,
            'client' => new ClientResource($this->whenLoaded('client')),
            'user' => new UserResource($this->whenLoaded('user')),
            'updated_by' => new UserResource($this->whenLoaded('updatedBy')),
            'vendors' => VendorResource::collection($this->whenLoaded('vendors')),
            'wedding_contract_notes' => $this->wedding_contract_notes,
            'reception_notes' => $this->reception_notes,
            'cashflow_in' => $this->cashflow_in,
            'cashflow_out' => $this->cashflow_out,
            'wedding_package' => $this->wedding_package,
            'wedding_date' => $this->wedding_date,
            'reservation_status' => $this->reservation_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
