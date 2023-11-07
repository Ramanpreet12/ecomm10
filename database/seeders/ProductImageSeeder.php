<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productImage = [
            [ 'id' => 1 , 'product_id' => 1,  'image_name' => '' , 'image_sort' => 1 , 'status' => 1],
            [ 'id' => 2 , 'product_id' => 1,  'image_name' => '' , 'image_sort' => 2 , 'status' => 1],
            [ 'id' => 3 , 'product_id' => 1,  'image_name' => '' , 'image_sort' => 3 , 'status' => 1],
            [ 'id' => 4 , 'product_id' => 1,  'image_name' => '' , 'image_sort' => 4 , 'status' => 1],
            [ 'id' => 5 , 'product_id' => 1,  'image_name' => '' , 'image_sort' => 5 , 'status' => 1],
        ];

        ProductImage::insert($productImage);
    }
}
