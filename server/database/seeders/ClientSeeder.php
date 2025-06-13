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
            // [
            //     'combined_name' => 'John & Jane',
            //     'groom' => 'John Doe',
            //     'bride' => 'Jane Smith',
            //     'telephone_num' => '08123432322'
            // ],
            // [
            //     'combined_name' => 'Jake & Maria',
            //     'groom' => 'Jake Bloke',
            //     'bride' => 'Maria Carolina',
            //     'telephone_num' => '08123412569'
            // ],
            // [
            //     'combined_name' => 'James & Siti',
            //     'groom' => 'James Slow',
            //     'bride' => 'Siti Nabilah',
            //     'telephone_num' => '08123465441'
            // ],
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
