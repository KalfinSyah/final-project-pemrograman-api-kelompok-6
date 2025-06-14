<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activites  = [
            [
                'reservation_id' => 1,
                'activity_type' => 'Reservasi Lokasi',
                'activity_name' => 'Reservasi Tempat Pernikahan',
                'activity_date' => '2025-06-20',
                'activity_desc' => 'Diskusi dengan pihak penanggung jawab lokasi.',
                'activity_status' => 'Pending'
            ],
            [
                'reservation_id' => 1,
                'activity_type' => 'Pelaksanaan Acara',
                'activity_name' => 'Pelaksanaan Acara Pernikahan',
                'activity_date' => '2025-06-26',
                'activity_desc' => 'Pelaksanaan acara pernikahan untuk client Budi dan Kartini.',
                'activity_status' => 'Pending'
            ],
            [
                'reservation_id' => 2,
                'activity_type' => 'Pemesanan Katering',
                'activity_name' => 'Memesan Katering',
                'activity_date' => '2025-06-28',
                'activity_desc' => 'Mendatangi katering Bagas Makan Siang untuk memesan katering pernikahan.',
                'activity_status' => 'Pending'
            ],
            [
                'reservation_id' => 2,
                'activity_type' => 'Koordinasi Staff',
                'activity_name' => 'Koordinasi Dengan Staff Dekor',
                'activity_date' => '2025-07-03',
                'activity_desc' => 'Diskusi awal dengan staff dan vendor dekorasi.',
                'activity_status' => 'Pending'
            ],
            [
                'reservation_id' => 2,
                'activity_type' => 'Reservasi Lokasi',
                'activity_name' => 'Reservasi Tempat Pernikahan',
                'activity_date' => '2025-07-10',
                'activity_desc' => 'Diskusi dengan pihak penanggung jawab lokasi.',
                'activity_status' => 'Pending'
            ],
            [
                'reservation_id' => 2,
                'activity_type' => 'Pelaksanaan Acara',
                'activity_name' => 'Pelaksanaan Acara Pernikahan',
                'activity_date' => '2025-07-10',
                'activity_desc' => 'Pelaksanaan acara pernikahan untuk client Rano dan Julia.',
                'activity_status' => 'Pending'
            ],
        ];

        foreach ($activites as $activity) {
            Activity::create($activity);
        };
    }
}
