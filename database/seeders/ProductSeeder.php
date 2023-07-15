<?php

namespace Database\Seeders;

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
        Product::create([
            'name' => 'ürün 1',
            'image' => 'images/cloth_1.jpg',
            'category_id' => '1',
            'short_text' => 'kısa bilgi',
            'price' => 100,
            'size' => 'small',
            'color' => 'beyaz',
            'qty' => 10,
            'status' => '1',
            'content' =>' <p> Ürün çok iyi </p>',
        ]);

        Product::create([
            'name' => 'ürün 2',
            'image' => 'images/shoe_1.jpg',
            'category_id' => '2',
            'short_text' => 'kısa bilgi',
            'price' => 50,
            'size' => 'large',
            'color' => 'siyah',
            'qty' => 5,
            'status' => '1',
            'content' =>' <p> Ürün çok iyi </p>',
        ]);
    }
}
