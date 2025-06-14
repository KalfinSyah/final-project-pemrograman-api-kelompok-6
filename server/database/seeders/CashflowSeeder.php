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
            [
                'user_id' => 1,
                'updated_by' => 1,
                'reservation_id' => 1,
                'cashflow_type' => 'Pendapatan',
                'amount' => 10000000,
                'cashflow_desc' => 'Client Membayar Uang DP',
                'cashflow_date' => '2025-06-10',
            ],
            [
                'user_id' => 1,
                'updated_by' => 1,
                'reservation_id' => 1,
                'cashflow_type' => 'Pengeluaran',
                'amount' => 6000000,
                'cashflow_desc' => 'Membayar Biaya Sewa Tempat',
                'cashflow_date' => '2025-06-20',
            ],
            [
                'user_id' => 1,
                'updated_by' => 1,
                'reservation_id' => 1,
                'cashflow_type' => 'Pendapatan',
                'amount' => 10000000,
                'cashflow_desc' => 'Client Membayar Sisa Uang DP',
                'cashflow_date' => '2025-06-23',
            ],
            [
                'user_id' => 1,
                'updated_by' => 1,
                'reservation_id' => 2,
                'cashflow_type' => 'Pengeluaran',
                'amount' => 400000,
                'cashflow_desc' => 'Membayar DP Katering',
                'cashflow_date' => '2025-06-30',
            ],
            [
                'user_id' => 1,
                'updated_by' => 1,
                'reservation_id' => 2,
                'cashflow_type' => 'Pendapatan',
                'amount' => 10000000,
                'cashflow_desc' => 'Client Membayar Uang DP',
                'cashflow_date' => '2025-07-04',
            ],
            [
                'user_id' => 1,
                'updated_by' => 1,
                'reservation_id' => 2,
                'cashflow_type' => 'Pengeluaran',
                'amount' => 7000000,
                'cashflow_desc' => 'Membayar Biaya Sewa Tempat',
                'cashflow_date' => '2025-07-12',
            ]
        ];

        foreach ($cashflows as $cashflow) {
            Cashflow::create($cashflow);
        }
    }
}
