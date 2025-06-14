<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'vendor_id' => $this->id,
            'vendor_type' => $this->vendor_type,
            'vendor_brand' => $this->vendor_brand,
        ];
    }
}
