<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients  = [
            [
                'combined_name' => 'Budi & Kartini',
                'groom' => 'Budi Pekerti',
                'bride' => 'Kartini Eka',
                'telephone_num' => '08123421880'
            ],
            [
                'combined_name' => 'Rano & Julia',
                'groom' => 'Rano Barno',
                'bride' => 'Julia Beres',
                'telephone_num' => '08123433477'
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        };
    }
}
