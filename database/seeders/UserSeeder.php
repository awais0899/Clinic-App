<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'role' => 'owner',
            'email' => 'owner@clinic.com',
        ]);

        User::factory()->create([
            'role' => 'therapist',
            'email' => 'therapist@clinic.com',
        ]);

        User::factory()->create([
            'role' => 'patient',
            'email' => 'patient@clinic.com',
        ]);
    }
}
