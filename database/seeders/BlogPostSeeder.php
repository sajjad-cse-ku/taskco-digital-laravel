<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use Faker\Factory as Faker;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create 30 sample blog posts
        for ($i = 1; $i <= 100; $i++) {
            BlogPost::create([
                'title' => $faker->sentence(6, true),
                'author' => $faker->name(),
                'content' => $faker->paragraphs(rand(3, 7), true),
            ]);
        }
    }
}
