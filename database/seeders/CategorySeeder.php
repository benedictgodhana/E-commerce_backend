<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    public function run()
    {
        // Main categories
        $electronics = Category::create(['name' => 'Electronics']);
        $clothing = Category::create(['name' => 'Clothing']);
        $homeAppliances = Category::create(['name' => 'Home Appliances']);

        // Subcategories
        $laptops = $electronics->children()->create(['name' => 'Laptops']);
        $smartphones = $electronics->children()->create(['name' => 'Smartphones']);
        $tvs = $electronics->children()->create(['name' => 'TVs']);

        // Add more subcategories as needed

        // You can continue nesting subcategories if required

        $this->command->info('Categories seeded successfully.');
    }
}

