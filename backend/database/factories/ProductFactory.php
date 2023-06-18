<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;
    public function definition()
    {
        $brandIds = Brand::pluck('id')->all();

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'voltage' => $this->faker->randomElement(['110V', '220V']),
            'material' => $this->faker->randomElement(['Plastic', 'Metal', 'Wood']),
            'department' => $this->faker->randomElement(['Electronics', 'Home', 'Kitchen']),
            'brand_id' => $this->faker->randomElement($brandIds),
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
