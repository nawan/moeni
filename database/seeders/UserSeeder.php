<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@pobox.com',
            'password' => Hash::make('19091991'),
            'no_kontak' => '081228062102',
            'nik' => '1234567898765432',
            'alamat' => 'Paker Bambanglipuro Bantul',
            'is_admin' => 1
        ]);
    }
}
