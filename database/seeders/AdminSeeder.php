<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Manthan Mistry',
            'email' => 'manthanmistry0121@gmail.com',
            'mobile' => '8320909090',
            'password' => Hash::make('Manthan@123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
