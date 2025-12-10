<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create government admin users
        $superadmin = User::create([
            'name' => 'Kepala Dinas Komunikasi dan Informatika',
            'email' => 'superadmin@mail.co',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'phone' => '081234567890',
            'position' => 'Kepala Dinas',
            'department' => 'Dinas Komunikasi dan Informatika',
            'is_active' => true,
        ]);

        $admin = User::create([
            'name' => 'Sekretaris Daerah',
            'email' => 'admin@mail.co',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567891',
            'position' => 'Sekretaris Daerah',
            'department' => 'Sekretariat Daerah',
            'is_active' => true,
        ]);

        // Load custom government data
        $this->call([
            CustomDataSeeder::class,
        ]);
    }
}