<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            BoardingHouseSeeder::class,
            BonusSeeder::class,
            RoomSeeder::class,
            RoomImageSeeder::class,
            TestimonialSeeder::class
        ]);
    }
}
