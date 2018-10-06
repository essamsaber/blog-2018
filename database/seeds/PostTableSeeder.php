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
        \Illuminate\Support\Facades\DB::table('posts')->truncate();
        $posts = [];
        $faker = \Faker\Factory::create();
        $date = \Carbon\Carbon::create(2018,9,1,9);
        for($i = 0; $i < 10; $i++) {
            $date->addDays(1);
            $published_date = clone($date);
            $created_date = clone($date);
            $image = 'Post_Image_' . rand(1,5) . ".jpg";
            $posts[] = [
                'author_id' => rand(1,3),
                'title' => $faker->sentence(rand(8,12)),
                'excerpt' => $faker->text(rand(250,300)),
                'body' => $faker->paragraphs(rand(10,15),true),
                'slug' => $faker->slug(),
                'image' => rand(0,1) == 1 ? $image : null,
                'created_at' => $created_date,
                'published_at' => $i < 5 ? $published_date : (rand(0,1) == 0 ? NULL : $published_date->addDays(4+$i)),
                'category_id' => rand(1,4)

            ];
        }
        \Illuminate\Support\Facades\DB::table('posts')->insert($posts);
    }
}
