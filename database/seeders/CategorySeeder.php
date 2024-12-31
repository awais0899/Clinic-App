<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Orthopedic Clinic',
                'description' => 'Specialized in treating musculoskeletal system conditions',
                'icon' => 'bone'
            ],
            [
                'name' => 'Chiropractic Clinic',
                'description' => 'Focus on diagnosis and treatment of mechanical disorders of the musculoskeletal system',
                'icon' => 'spine'
            ],
            // Add more categories as needed
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon']
            ]);
        }
    }
}