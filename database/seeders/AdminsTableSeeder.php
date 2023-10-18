<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('admin@123');
        $adminRecords = [
            [
                'id'=> 4,
                'name' => 'Ramanpreet',
                'type' => 'subadmin',
                'mobile' => '1234567891',
                'email' => 'ramanpreet@gmail.com',
                'password' => $password,
                'image' => '',
                'status' => '1',
            ],
            [
                'id'=> 5,
                'name' => 'Simrandeep',
                'type' => 'subadmin',
                'mobile' => '1234567891',
                'email' => 'simrandeep@gmail.com',
                'password' => $password,
                'image' => '',
                'status' => '1',
            ],

        ];
        Admin::insert($adminRecords);
    }
}
