<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cashflow;

class CashflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashflows = [
            ['reservation_id' => 1, 'cashflow_type' => 'Pendapatan', 'amount' => 2000000],
            ['reservation_id' => 1, 'cashflow_type' => 'Pengeluaran', 'amount' => 6000000],
            ['reservation_id' => 1, 'cashflow_type' => 'Pendapatan', 'amount' => 2300000],
            ['reservation_id' => 2, 'cashflow_type' => 'Pengeluaran', 'amount' => 800000],
            ['reservation_id' => 2, 'cashflow_type' => 'Pendapatan', 'amount' => 3000000],
            ['reservation_id' => 2, 'cashflow_type' => 'Pengeluaran', 'amount' => 1800000]
        ];

        foreach ($cashflows as $cashflow) {
            Cashflow::create($cashflow);
        }
    }
}
