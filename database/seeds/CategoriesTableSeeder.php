<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categories')->truncate();
        \Illuminate\Support\Facades\DB::table('categories')
            ->insert([
                [
                    'name' => 'Web Development',
                    'slug' => 'web-development'
                ],
                [
                    'name' => 'Web Design',
                    'slug' => 'web-design'
                ],
                [
                    'name' => 'Social Marketing',
                    'slug' => 'social-marketing'
                ],
                [
                    'name' => 'Programming Languages',
                    'slug' => 'programming-languages'
                ],

            ]);
        for($i = 1; $i <= 10; $i++) {
            $category_id = rand(1,4);
            \Illuminate\Support\Facades\DB::table('posts')
                ->where('id', $i)
                ->update(['category_id' => $category_id]);
        }
    }
}
