<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()->create([
            'name' => 'Electrolux',
            'description' => 'Description for Electrolux brand',
        ]);

        Brand::factory()->create([
            'name' => 'Brastemp',
            'description' => 'Description for Brastemp brand',
        ]);

        Brand::factory()->create([
            'name' => 'Fischer',
            'description' => 'Description for Fischer brand',
        ]);

        Brand::factory()->create([
            'name' => 'Samsung',
            'description' => 'Description for Samsung brand',
        ]);

        Brand::factory()->create([
            'name' => 'LG',
            'description' => 'Description for LG brand',
        ]);
    }
}
