<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'user_id'    => 1,
                'post_id'    => 2,
                'rating'    => 3.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 1,
                'post_id'    => 3,
                'rating'    => 4.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 1,
                'post_id'    => 4,
                'rating'    => 5.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 1,
                'post_id'    => 5,
                'rating'    => 1.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 1,
                'post_id'    => 6,
                'rating'    => 1.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 2,
                'post_id'    => 7,
                'rating'    => 1.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 2,
                'post_id'    => 6,
                'rating'    => 3.6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 2,
                'post_id'    => 5,
                'rating'    => 2.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 3,
                'post_id'    => 4,
                'rating'    => 5.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 3,
                'post_id'    => 3,
                'rating'    => 2.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 3,
                'post_id'    => 2,
                'rating'    => 3.4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
