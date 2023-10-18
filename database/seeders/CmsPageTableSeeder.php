<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPageRecords = [
            ['id' => 1 , 'title' => 'About us' , 'url' => 'about-us' , 'description'=> 'about us content' ,
             'meta_title' => 'about us',  'meta_keyword' => 'about us',  'meta_description' => 'about us content','status' => 1],
             ['id' => 2 , 'title' => 'Terms and Conditions us' , 'url' => 'terms-and-conditions' , 'description'=> 'Terms and Conditions' ,
             'meta_title' => 'Terms and Conditions',  'meta_keyword' => 'Terms and Conditions',  'meta_description' => 'Terms and Conditions','status' => 1],
             ['id' => 3 , 'title' => 'Privacy Policy' , 'url' => 'privacy-policy' , 'description'=> 'Privacy Policy' ,
             'meta_title' => 'privacy-policy',  'meta_keyword' => 'privacy-policy',  'meta_description' => 'Privacy Policy','status' => 1],

        ];
        CmsPage::insert($cmsPageRecords);
    }
}
