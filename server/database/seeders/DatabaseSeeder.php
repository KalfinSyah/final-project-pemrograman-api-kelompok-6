<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Calender;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ClientSeeder::class,
            ReservationAndVendorSeeder::class,
            ActivitySeeder::class,
            CashflowSeeder::class,
            ReservationCashflowUpdateSeeder::class,
        ]);
    }
}
