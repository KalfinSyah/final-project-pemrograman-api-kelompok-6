<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Cashflow;

class ReservationCashflowUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::all()->each(function ($reservation) {
            $in = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pendapatan')
                ->sum('amount');

            $out = Cashflow::where('reservation_id', $reservation->id)
                ->where('cashflow_type', 'Pengeluaran')
                ->sum('amount');

            $reservation->update([
                'cashflow_in' => $in,
                'cashflow_out' => $out
            ]);
        });
    }
}
