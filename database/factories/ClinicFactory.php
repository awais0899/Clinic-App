<?php

namespace Database\Factories;

use App\Models\Clinic;
use App\Models\User;
use App\Models\Category; // Assuming a Category model exists
use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicFactory extends Factory
{
    protected $model = Clinic::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(), // Ensure a related category is created
            'owner_id' => User::factory(),
            'name' => $this->faker->company,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'working_hours_start' => '09:00:00',
            'working_hours_end' => '17:00:00',
            'working_days' => json_encode(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'is_active' => true,
        ];
    }
}
