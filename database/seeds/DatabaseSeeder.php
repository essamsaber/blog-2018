<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(PostTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(LaratrustSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(CommentsTableSeeder::class);

    }
}
