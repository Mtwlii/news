<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Post = Post::factory()->count(50)->create();

        $Post->each(function ($Post) {
            Image::factory(2)->create([
                'post_id' => $Post->id,
            ]);
        });
    }
}
