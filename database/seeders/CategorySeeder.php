<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect(['Livre', 'Jeux-Vidéo', 'Film']);

        $categories->each(fn ($category) => Category::create([
            'name' => $category,
            'slug' => Str::slug($category),
        ]));
    }
}
