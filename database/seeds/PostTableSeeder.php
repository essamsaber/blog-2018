<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [];
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 10; $i++) {
            $image = 'Post_Image_' . rand(1,5) . ".jpg";
            $posts[] = [
                'author_id' => rand(1,3),
                'title' => $faker->sentence(rand(8,12)),
                'excerpt' => $faker->text(rand(250,300)),
                'body' => $faker->paragraphs(rand(10,15),true),
                'slug' => $faker->slug(),
                'image' => rand(0,1) == 1 ? $image : null,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now')

            ];
        }
        \Illuminate\Support\Facades\DB::table('posts')->insert($posts);
    }
}
