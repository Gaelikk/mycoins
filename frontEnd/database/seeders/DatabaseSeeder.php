<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function run(): void
    {
        $this->call(YearsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(CoinsSeeder::class);
        $this->call(PlacesSeeder::class);
        User::factory(3)->create();
        Place::factory(100)->create();
        User::create([
            'nickname' => 'gael',
            'email' => 'gael@gael.com',
            'password' => Hash::make('1234'),
            'name' => 'Gael',
            'surname' => 'Caraballo',
            'avatar' => 'icon.png',
            'country_id' => 205,
            'isAdmin' => 1
            //'collection_id' => fake()->unique()->randomNumber(),
        ]);
    }
}
