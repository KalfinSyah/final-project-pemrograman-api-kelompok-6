<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ReservationAndVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            ['vendor_type' => 'Venue', 'vendor_brand' => 'Gita Tantama'],
            ['vendor_type' => 'Dekorasi', 'vendor_brand' => 'Christal'],
            ['vendor_type' => 'Sound', 'vendor_brand' => 'Nasir'],
        ];

        $vendorModels = []; // untuk menyimpan instance Vendor
        foreach ($vendors as $vendor) {
            $vendorModels[] = Vendor::create($vendor);
        }
        $vendorIds = collect($vendorModels)->pluck('id')->toArray();

        $reservations = [
            [
                'user_id' => 1,
                'updated_by' => 1,
                'client_id' => 1,
                'marriage_contract_notes' => 'Keluarga yang duduk di area akad : 1.2.3.4.',
                'reception_notes' => 'Jumlah kursi keluarga PW : Jumlah kursi keluarga PP :',
                'cashflow_in' => 0,
                'cashflow_out' => 0,
                'wedding_package' => 'A',
            ],
            [
                'user_id' => 1,
                'updated_by' => 1,
                'client_id' => 2,
                'marriage_contract_notes' => 'Keluarga yang duduk di area akad : 1.2.3.4.',
                'reception_notes' => 'Jumlah kursi keluarga PW : Jumlah kursi keluarga PP :',
                'cashflow_in' => 0,
                'cashflow_out' => 0,
                'wedding_package' => 'B'
            ]
        ];

        foreach ($reservations as $reservation) {
            $reservationModel = Reservation::create($reservation);

            // Ambil vendor secara acak (antara 1–jumlah vendor) untuk tiap reservasi
            $randomVendorIds = collect($vendorIds)
                ->shuffle()
                ->take(rand(1, count($vendorIds)))
                ->values()
                ->toArray();

            // Hubungkan ke vendor menggunakan sync
            $reservationModel->vendors()->sync($randomVendorIds);
        }
    }
}
