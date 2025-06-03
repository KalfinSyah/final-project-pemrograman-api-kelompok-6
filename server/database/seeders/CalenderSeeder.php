<?php

namespace Database\Seeders;

use App\Models\Calender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calenders = [
            ['calender_name' => 'Reservasi Lokasi', 'calender_date' => '2025-06-14', 'calender_status' => 'Pending', 'reservation_id' => 1],
            ['calender_name' => 'Pemesanan Katering', 'calender_date' => '2025-05-28', 'calender_status' => 'Selesai', 'reservation_id' => 2],
            ['calender_name' => 'Koordinasi Staff', 'calender_date' => '2025-06-10', 'calender_status' => 'Batal', 'reservation_id' => 2],
            ['calender_name' => 'Pelaksanaan Acara', 'calender_date' => '2025-06-20', 'calender_status' => 'Pending', 'reservation_id' => 2],
            ['calender_name' => 'Reservasi Lokasi', 'calender_date' => '2025-05-14', 'calender_status' => 'Mundur', 'reservation_id' => 1],
            ['calender_name' => 'Reservasi Lokasi', 'calender_date' => '2025-05-28', 'calender_status' => 'Selesai', 'reservation_id' => 1]
        ];

        foreach ($calenders as $calender) {
            Calender::create($calender);
        }
    }
}
