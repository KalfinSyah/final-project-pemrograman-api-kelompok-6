<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CashflowGroupResource extends JsonResource
{
    public function toArray($request)
    {
        // Group data berdasarkan bulan (format: "Juni", "Mei", dst)
        return $this->groupBy(function ($item) {
            return Carbon::parse($item->cashflow_date)->translatedFormat('F');
        })->map(function ($group) {
            return $group->map(function ($cashflow) {
                return [
                    'cashflow_id' => $cashflow->id,
                    'cashflow_type' => $cashflow->cashflow_type,
                    'amount' => $cashflow->amount,
                    'cashflow_desc' => $cashflow->cashflow_desc,
                    'cashflow_date' => $cashflow->cashflow_date,
                ];
            });
        });
    }
}
