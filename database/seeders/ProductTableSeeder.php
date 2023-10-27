<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productRecords = [
            [ 'id' => 1 , 'category_id' => 1 , 'brand_id' => 0 , 'product_name' => 'Kurta' ,
            'product_code' => 'Kurta1200' , 'product_price' => '1500' ,'product_discount' => '10' ,
            'discount_type' => 'product' ,'final_price' => 0 ,'product_description' => 'Pure Cotton Kurta' ,
            'product_video' => '' ,'product_weight' => '' , 'product_color' => 'Off White' ,'family_color' => 'White' ,
            'group_code' => 'FSHIRT1300' ,'wash_care' => 'Machine Wash' ,'keywords' => 'Kurta' ,
            'fabric' => 'Cotton' ,'pattern' => 'Flower' ,'sleeve' => 'full sleeves' ,
            'fit' => '' ,'occassion' => 'Casual wear' ,'meta_title' => 'Kurta',
            'meta_keywords' => 'Kurta' ,'meta_description' => 'Kurta' ,'is_featured' => 'Yes' ,
            'status' => 1],

            [ 'id' => 2 , 'category_id' => 13 , 'brand_id' => 0 , 'product_name' => 'Formal Shirts' ,
            'product_code' => 'FSH1300' , 'product_price' => '1500' ,'product_discount' => '10' ,
            'discount_type' => 'product' ,'final_price' => 0 ,'product_description' => 'Pure Cotton Formal Shirts' ,
            'product_video' => '' ,'product_weight' => '' , 'product_color' => 'Off White' ,'family_color' => 'White' ,
            'group_code' => 'FSHIRT1300' ,'wash_care' => 'Machine Wash' ,'keywords' => 'Formal Shirts' ,
            'fabric' => 'Cotton' ,'pattern' => 'none' ,'sleeve' => 'full sleeves' ,
            'fit' => '' ,'occassion' => 'Office wear' ,'meta_title' => 'Formal Shirts',
            'meta_keywords' => 'Formal Shirts' ,'meta_description' => 'Formal Shirts' ,'is_featured' => 'Yes' ,
            'status' => 1],



            [ 'id' => 3 , 'category_id' => 5 , 'brand_id' => 0 , 'product_name' => 'Jeans' ,
            'product_code' => 'FSH1300' , 'product_price' => '1500' ,'product_discount' => '10' ,
            'discount_type' => 'product' ,'final_price' => 0 ,'product_description' => 'Pure Cotton Jeans' ,
            'product_video' => '' ,'product_weight' => '' , 'product_color' => 'Off White' ,'family_color' => 'White' ,
            'group_code' => 'FSHIRT1300' ,'wash_care' => 'Machine Wash' ,'keywords' => 'Jeans' ,
            'fabric' => 'Cotton' ,'pattern' => 'none' ,'sleeve' => 'full sleeves' ,
            'fit' => '' ,'occassion' => 'Office wear' ,'meta_title' => 'Jeans',
            'meta_keywords' => 'Jeans' ,'meta_description' => 'Jeans' ,'is_featured' => 'Yes' ,
            'status' => 1],



            [ 'id' => 4 , 'category_id' => 4 , 'brand_id' => 0 , 'product_name' => 'Jacket' ,
            'product_code' => 'FSH1300' , 'product_price' => '1500' ,'product_discount' => '10' ,
            'discount_type' => 'product' ,'final_price' => 0 ,'product_description' => 'Pure Cotton Jacket' ,
            'product_video' => '' ,'product_weight' => '' , 'product_color' => 'Off White' ,'family_color' => 'White' ,
            'group_code' => 'FSHIRT1300' ,'wash_care' => 'Machine Wash' ,'keywords' => 'Jacket' ,
            'fabric' => 'Cotton' ,'pattern' => 'none' ,'sleeve' => 'full sleeves' ,
            'fit' => '' ,'occassion' => 'Office wear' ,'meta_title' => 'Jacket',
            'meta_keywords' => 'Jacket' ,'meta_description' => 'Jacket' ,'is_featured' => 'Yes' ,
            'status' => 1],

            [ 'id' => 5 , 'category_id' => 1 , 'brand_id' => 0 , 'product_name' => 'Tops' ,
            'product_code' => 'FSH1300' , 'product_price' => '1500' ,'product_discount' => '10' ,
            'discount_type' => 'product' ,'final_price' => 0 ,'product_description' => 'Pure Cotton Tops' ,
            'product_video' => '' ,'product_weight' => '' , 'product_color' => 'Off White' ,'family_color' => 'White' ,
            'group_code' => 'FSHIRT1300' ,'wash_care' => 'Machine Wash' ,'keywords' => 'Tops' ,
            'fabric' => 'Cotton' ,'pattern' => 'none' ,'sleeve' => 'full sleeves' ,
            'fit' => '' ,'occassion' => 'Office wear' ,'meta_title' => 'Tops',
            'meta_keywords' => 'Tops' ,'meta_description' => 'Tops' ,'is_featured' => 'Yes' ,
            'status' => 1],
        ];
        Product::insert($productRecords);
    }
}
