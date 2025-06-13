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
                'reservation_id' => 1,
                'cashflow_type' => 'Pendapatan',
                'amount' => 10000000,
                'cashflow_desc' => 'Client Membayar Uang DP',
                'created_at' => '2025-06-10 10:00:00',
                'updated_at' => '2025-06-10 10:00:00'
            ],
            [
                'reservation_id' => 1,
                'cashflow_type' => 'Pengeluaran',
                'amount' => 6000000,
                'cashflow_desc' => 'Membayar Biaya Sewa Tempat',
                'created_at' => '2025-06-20 10:00:00',
                'updated_at' => '2025-06-20 10:00:00'
            ],
            [
                'reservation_id' => 1,
                'cashflow_type' => 'Pendapatan',
                'amount' => 10000000,
                'cashflow_desc' => 'Client Membayar Sisa Uang DP',
                'created_at' => '2025-06-23 10:00:00',
                'updated_at' => '2025-06-23 10:00:00'
            ],
            [
                'reservation_id' => 2,
                'cashflow_type' => 'Pengeluaran',
                'amount' => 400000,
                'cashflow_desc' => 'Membayar DP Katering',
                'created_at' => '2025-06-30 10:00:00',
                'updated_at' => '2025-06-30 10:00:00'
            ],
            [
                'reservation_id' => 2,
                'cashflow_type' => 'Pendapatan',
                'amount' => 10000000,
                'cashflow_desc' => 'Client Membayar Uang DP',
                'created_at' => '2025-07-04 10:00:00',
                'updated_at' => '2025-07-04 10:00:00'
            ],
            [
                'reservation_id' => 2,
                'cashflow_type' => 'Pengeluaran',
                'amount' => 7000000,
                'cashflow_desc' => 'Membayar Biaya Sewa Tempat',
                'created_at' => '2025-07-12 10:00:00',
                'updated_at' => '2025-07-12 10:00:00'
            ]
        ];

        foreach ($cashflows as $cashflow) {
            Cashflow::create($cashflow);
        }
    }
}
