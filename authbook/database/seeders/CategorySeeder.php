<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Fiksi', 'Non-Fiksi', 'Novel', 'Sains', 'Sejarah',
            'Biografi', 'Teknologi', 'Pendidikan', 'Anak-anak', 'Agama',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}