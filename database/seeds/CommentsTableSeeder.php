<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $posts = \App\Post::published()->get();

        foreach($posts as $post) {
            for($i=0; $i <= rand(5,10); $i++) {
                $post->comments()->create([
                    'author_name' => $faker->userName,
                    'author_email' => $faker->safeEmail,
                    'body' => $faker->paragraphs(rand(1,3), true)
                ]);
            }
        }
    }
}
