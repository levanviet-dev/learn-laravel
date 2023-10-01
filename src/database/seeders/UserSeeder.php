<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_code' => 'user1',
            'name' => 'name1',
            'email' => 'email1@gmail.com',
            'password' => 'password@123',
            'company_name' => 'Company test 1',
            'first_name_manager' => 'Klaus',
            'last_name_manager' => 'Peter',
            'department' => 'Department test 1',
            'postal_code' => '100001',
            'prefecture' => 'Hoang Mai',
            'address' => '123 Hoang Mai',
            'building_name' => 'D Office',
            'phone_number' => '0123456789',
        ]);
        User::create([
            'user_code' => 'user2',
            'name' => 'name2',
            'email' => 'email2@gmail.com',
            'password' => 'password@123',
            'company_name' => 'Company test 2',
            'first_name_manager' => 'Klaus',
            'last_name_manager' => 'John',
            'department' => 'Department test 2',
            'postal_code' => '100002',
            'prefecture' => 'Dong Da',
            'address' => '123 Dong Da',
            'building_name' => 'D Office',
            'phone_number' => '0123456788',
        ]);
    }
}
