<?php

use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PostSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(UserSeeder::class);
    }
}
