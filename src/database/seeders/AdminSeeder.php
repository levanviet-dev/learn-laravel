<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'admin_code' => 'admin1',
            'password' => 'password@123',
            'name' => 'Admin LTE 1',
            'role_id' => 1
        ]);
        Admin::create([
            'admin_code' => 'admin2',
            'password' => 'password@123',
            'name' => 'Admin LTE 2',
            'role_id' => 1
        ]);
        Admin::create([
            'admin_code' => 'admin3',
            'password' => 'password@123',
            'name' => 'Admin LTE 3',
            'role_id' => 1
        ]);
        Admin::create([
            'admin_code' => 'admin4',
            'password' => 'password@123',
            'name' => 'Admin LTE 4',
            'role_id' => 1
        ]);
    }
}
