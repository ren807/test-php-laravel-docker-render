<?php

use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\TagSeeder;

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
    }
}
