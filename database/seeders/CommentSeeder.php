<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();
        Comment::factory(20)
        ->sequence(fn() => [
            'user_id' => $users->random(),
            'post_id' => $posts->random(),
            'parent_id' => rand(1,20),
        ])
        ->create();
        
        

        
    }
}
