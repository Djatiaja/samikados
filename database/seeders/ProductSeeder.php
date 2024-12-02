<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(50)->create();

        $categories=[
            "Banner & Spanduk" => "Cetak banner dan spanduk untuk kebutuhan promosi acara atau bisnis.",
            "Kotak Kemasan & Packaging" => "Layanan cetak kotak kemasan dan packaging yang menarik untuk produk Anda."
        ];

        foreach ($categories as $key => $value) {
            Category::factory()->create([
                'name'=>$key,
                'description'=>$value
            ]);
        }
    }
}
