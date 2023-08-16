<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'Admin',
            'password' => Hash::make('admin123'),
            'status' => 'Admin'
        ]);

        Officer::create([
            'name' => 'Admin',
            'nik' => '33101230123012',
            'date_of_birth' => '1995-10-2',
            'gender' => 'Laki-laki',
            'address' => 'Bogor',
            'phone' => '0812371237482',
            'position' => 'Manager',
            'officer_picture' => '',
            'user_id' => 1
        ]);
    }
}
