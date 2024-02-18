<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('receptionists')->insert([
            'username' => 'LucasBogo',
            'name' => 'Lucas Bogo', // Assuming you have a name field
            'password' => Hash::make('secret'), // Use a secure password in production
            // Add any other necessary fields such as 'email' if required
        ]);
    }
}
