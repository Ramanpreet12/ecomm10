<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_attribute_records = [
            ['id' => 1, 'product_id' => 1 ,'size' =>'small','sku' => 'BT0011','price' => '500','stock' => '9','status' => '1'],
            ['id' => 2, 'product_id' => 2 ,'size' =>'medium','sku' => 'BT0013','price' => '600','stock' => '10','status' => '1'],
            ['id' => 3, 'product_id' => 3 ,'size' =>'large','sku' => 'BT0014','price' => '700','stock' => '4','status' => '1'],
        ];
        ProductAttribute::insert($product_attribute_records);

    }
}
