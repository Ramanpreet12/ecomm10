<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FamilyColor;

class FamilyColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $family_colors = [
            ['id' => 1 , 'color_name' => 'White' , 'color_code' => '#FFFFFF'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2 , 'color_name' => 'Silver' , 'color_code' => '#C0C0C0'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3 , 'color_name' => 'Gray' , 'color_code' => '#808080'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4 , 'color_name' => 'Black' , 'color_code' => '#000000'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5 , 'color_name' => 'Red' , 'color_code' => '#FF0000'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6 , 'color_name' => 'Maroon' , 'color_code' => '#800000'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7 , 'color_name' => 'Yellow' , 'color_code' => '#FFFF00'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8 , 'color_name' => 'Olive' , 'color_code' => '#808000'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9 , 'color_name' => 'Lime' , 'color_code' => '#00FF00'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10 , 'color_name' => 'Green' , 'color_code' => '#008000'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'color_name' => 'Aqua' , 'color_code' => '#00FFFF'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'color_name' => 'Teal' , 'color_code' => '#008080'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'color_name' => 'Blue' , 'color_code' => '#0000FF'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'color_name' => 'Navy' , 'color_code' => '#000080'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'color_name' => 'Fuchsia' , 'color_code' => '#FF00FF'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'color_name' => 'Purple' , 'color_code' => '#FF00FF'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'color_name' => 'Pink' , 'color_code' => '#FFC0CB'  , 'status' => 1 , 'created_at' => now(), 'updated_at' => now()],
        ];

        FamilyColor::insert($family_colors);
    }
}
