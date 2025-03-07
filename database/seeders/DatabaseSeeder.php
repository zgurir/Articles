<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory(20)->create();
      
        
       $this->call([
           CategorySeeder::class,
           TagSeeder::class,
           PostSeeder::class,
           CommentSeeder::class,
       ]);
       
    }
}
