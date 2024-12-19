<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\PseudoTypes\True_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public static $thumbnail = "public/thumbnail/example.png";

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "brand_id"=>Brand::all()->random(),
            "category_id"=>Category::all()->random(),
            "seller_id"=>Seller::all()->random(),
            "sku"=>fake()->text(150),
            "thumbnail"=>static::$thumbnail,
            "name"=>fake()->word(),
            "description"=>fake()->word(),
            "unit"=>fake()->numberBetween(0,100),
            "weight"=>fake()->numberBetween(1,20),
            "min_qty"=>fake()->numberBetween(1,10),
            "buy_price"=>fake()->numberBetween(10,100) * 1000,
            "price"=>fake()->numberBetween(10,100) * 1000,
            "is_publish"=>fake()->randomElement([True,false]),
            "deleted_at" => null,
        ];
    }
}
