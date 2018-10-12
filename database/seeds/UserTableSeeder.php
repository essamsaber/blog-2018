<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        $faker = \Faker\Factory::create();
        \Illuminate\Support\Facades\DB::table('users')->insert(
            [
                [
                    'name' => 'Essam Saber',
                    'email' => 'root.esso@gmail.com',
                    'password' => bcrypt(123),
                    'slug' => str_slug('Essam Saber'),
                    'bio' => $faker->text(rand(100,200))
                ],
                [
                    'name' => 'Moneim Saber',
                    'email' => 'moneim@gmail.com',
                    'password' => bcrypt(123),
                    'slug' => str_slug('Moneim Saber'),
                    'bio' => $faker->text(rand(100,200))
                ],
                [
                    'name' => 'Ahmed Mohamed',
                    'email' => 'ahmed@gmail.com',
                    'password' => bcrypt(123),
                    'slug' => str_slug('Ahmed Mohamed'),
                    'bio' => $faker->text(rand(100,200))
                ],
            ]
        );
    }
}
