<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;




class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->create([
            'title' => 'Pona Nini',
            'slug' => 'Panini',
            'excerpt' => 'lourd morceau surtout le couplet de Proto',
            'content' => 'un morceau du dernier album de Tiakola (ex membre du 4keus Gang) sorti en 2024',
            'thumbnail' => 'jolie cover de fifou',

        ]);

        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();


        Post::factory(20)
        ->sequence(fn() => [
            'user_id' => $users->random(),
            'category_id' => $categories->random(),
        ])
        ->create()
        ->each(fn ($post) => $post->tags()->attach($tags->random(rand(0, 3))));


    }
}
