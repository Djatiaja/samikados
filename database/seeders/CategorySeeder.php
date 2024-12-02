<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Kartu Nama" => "Cetak kartu nama profesional dengan desain kreatif untuk keperluan bisnis Anda.",
            "Brosur & Flyer" => "Buat brosur dan flyer berkualitas tinggi untuk promosi produk atau layanan Anda.",
            "Poster" => "Cetak poster berbagai ukuran dengan warna tajam dan detail sempurna.",
            "Buku & Majalah" => "Layanan percetakan untuk buku, majalah, atau jurnal dengan hasil cetak premium.",
            "Kalender" => "Desain dan cetak kalender custom untuk bisnis atau pribadi.",
            "Undangan" => "Cetak undangan elegan untuk acara spesial seperti pernikahan atau ulang tahun.",
            "Stiker & Label" => "Percetakan stiker dan label custom untuk produk atau promosi.",
            "Merchandise Custom" => "Cetak merchandise seperti mug, kaos, atau tote bag dengan desain sesuai keinginan Anda.",
        ];

        foreach ($categories as $key => $value) {
            Category::factory()->create([
                'name'=>$key,
                'description'=>$value
            ]);   
        }
    }
}
