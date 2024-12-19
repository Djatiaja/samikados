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

        $produkPercetakan = [
            "Kartu Nama Premium",
            "Banner Vinyl Outdoor",
            "Flyer Full Color",
            "Poster Custom Design",
            "Brosur Lipat 3",
            "Sticker Die Cut",
            "Undangan Pernikahan Eksklusif",
            "Buku Agenda Custom",
            "Box Kemasan Cetak",
            "Notebook Hardcover"
        ];

        foreach ($produkPercetakan as $key => $value) {
            Product::factory()->create([
                'name' => $value
            ]);
        }


        Product::factory()->count(50)->create();

        $categories=[
            "Banner dan Spanduk" => "Cetak banner dan spanduk untuk kebutuhan promosi acara atau bisnis.",
            "Kotak Kemasan dan Packaging" => "Layanan cetak kotak kemasan dan packaging yang menarik untuk produk Anda."
        ];

        foreach ($categories as $key => $value) {
            Category::factory()->create([
                'name'=>$key,
                'description'=>$value
            ]);
        }

    }
}
