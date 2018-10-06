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

        \Illuminate\Support\Facades\DB::table('users')->insert(
            [
                [
                    'name' => 'Essam',
                    'email' => 'root.esso@gmail.com',
                    'password' => bcrypt(123)
                ],
                [
                    'name' => 'Moneim',
                    'email' => 'moneim@gmail.com',
                    'password' => bcrypt(123)
                ],
                [
                    'name' => 'Ahmed',
                    'email' => 'ahmed@gmail.com',
                    'password' => bcrypt(123)
                ],
            ]
        );
    }
}
