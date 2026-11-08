<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Akun guru untuk login pertama kali.
     * Email: guru@sekolah.test | Password: password
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'guru@sekolah.test'],
            [
                'name' => 'Guru Admin',
                'password' => bcrypt('password'),
                'role' => 'teacher',
            ]
        );
    }
}
