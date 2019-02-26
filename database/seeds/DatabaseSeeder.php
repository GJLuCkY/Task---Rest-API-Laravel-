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
        $this->call([
            TownsTableSeeder::class,
            UsersTableSeeder::class,
            // PostsTableSeeder::class,
            // CommentsTableSeeder::class,
        ]);
    }
}
