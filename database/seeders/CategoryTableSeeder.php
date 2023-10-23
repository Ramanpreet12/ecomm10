<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecords = [

            ['id' => 1 , 'parent_id' => 0,  'category_name' => 'Clothing',  'category_image' => '',
            'category_discount' => 0,'description' => 'Clothing','url' => 'clothing','meta_title' => 'Clothing',
            'meta_keyword' => 'Clothing','meta_description' => 'Clothing','status' => 1, ],

            ['id' => 2 , 'parent_id' => 0,  'category_name' => 'Electronics',  'category_image' => '',
            'category_discount' => 0,'description' => 'Electronics','url' => 'electronics','meta_title' => 'electronics',
            'meta_keyword' => 'electronics','meta_description' => 'electronics','status' => 1, ],

            ['id' => 3 , 'parent_id' => 0,  'category_name' => 'Appliances',  'category_image' => '',
            'category_discount' => 0,'description' => 'Appliances','url' => 'appliances','meta_title' => 'appliances',
            'meta_keyword' => 'appliances','meta_description' => 'appliances','status' => 1, ],

            ['id' => 4 , 'parent_id' => 1,  'category_name' => 'Men',  'category_image' => '',
            'category_discount' => 0,'description' => 'Men','url' => 'men','meta_title' => 'Men',
            'meta_keyword' => 'Men','meta_description' => 'Men','status' => 1, ],

            ['id' => 5 , 'parent_id' => 1,  'category_name' => 'Women',  'category_image' => '',
            'category_discount' => 0,'description' => 'Women','url' => 'women','meta_title' => 'Women',
            'meta_keyword' => 'Women','meta_description' => 'Women','status' => 1, ],

            ['id' => 6 , 'parent_id' => 1,  'category_name' => 'Kids',  'category_image' => '',
            'category_discount' => 0,'description' => 'Kids','url' => 'kids','meta_title' => 'Kids',
            'meta_keyword' => 'Kids','meta_description' => 'Kids','status' => 1, ],

        ];
        Category::insert($categoryRecords);

    }
}
