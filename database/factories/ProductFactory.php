<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        $categoryId = [1,2,3,4,5,6,7,8,9];
        $sizelist = ['XS','S','M','L','XL'];
        $color = ['Beyaz','Siyah','Kahverengi','Mor'];

        $colortext = $color[random_int(0,3)];
        $size = $sizelist[random_int(0,4)];
        return [
            'name'=> $colortext.' '.$size. ' Urun',
            'image' => 'images/cloth_1.jpg',
            'category_id'=> $categoryId[random_int(0,8)],
            'short_text'=> $categoryId[random_int(0,8)]."id' li ürün",
            'price'=> random_int(100,2000),
            'size'=>$size,
            'color'=>$colortext,
            'status'=> '1',
            'qty'=>1,
            'content'=> fake()->paragraph(),
        ];
    }
}
