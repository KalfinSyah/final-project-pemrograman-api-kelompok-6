<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'client_id' => $this->id,
            'combined_name' => $this->combined_name,
            'groom' => $this->groom,
            'bride' => $this->bride,
            'telephone_num' => $this->telephone_num,
        ];
    }
}
