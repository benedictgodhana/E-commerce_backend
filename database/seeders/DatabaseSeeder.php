<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the CategorySeeder to populate categories
        $this->call(CategorySeeder::class);

        // You can uncomment the following lines if you have other seeders to run
        // $this->call(OtherSeeder::class);
        // $this->call(AnotherSeeder::class);
    }
}
