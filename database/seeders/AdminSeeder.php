<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        $admins = [
            [
                'full_name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => '12345678',
                'contact_no'    => '1234567890',
                'type'  => 'admin',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
