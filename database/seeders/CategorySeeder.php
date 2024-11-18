<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding categories specific to a cafe
        Category::create([
            'name' => 'Beverages',
        ]);

        Category::create([
            'name' => 'Snacks',
        ]);

        Category::create([
            'name' => 'Desserts',
        ]);

        Category::create([
            'name' => 'Meals',
        ]);
    }
}
