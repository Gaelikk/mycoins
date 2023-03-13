<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Place::create([
            'city_name' => 'Hostalets de Balenyà',
            'postcode' => '08550',
            'street_name' => 'Plaça de Bosch i Jover, 1',
            'country_id' => 205,
            'latitude' => 41.81561239511879,
            'longitude' => 2.235918480841667,
        ]);
    }
}
