<?php

namespace Database\Seeders;

use App\Models\Finishing;
use App\Models\Product;
use App\Models\Product_finishing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductFinishingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $products = Product::all();
        $finishings = Finishing::all();

        foreach ($products as $product) {
            foreach ($finishings as $finishing) {
                Product_finishing::factory()->create(["product_id"=>$product->id, "finishing_id"=>$finishing->id]);
            }
        }
    }
}
