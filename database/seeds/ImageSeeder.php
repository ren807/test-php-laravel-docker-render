<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            [
                'image_url'    => 'https://via.placeholder.com/600x400',
                'post_id'      => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'image_url'    => 'https://via.placeholder.com/600x400',
                'post_id'      => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'image_url'    => 'https://via.placeholder.com/600x400',
                'post_id'      => 4,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'image_url'    => 'https://via.placeholder.com/600x400',
                'post_id'      => 5,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'image_url'    => 'https://via.placeholder.com/600x400',
                'post_id'      => 6,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'image_url'    => 'https://via.placeholder.com/600x400',
                'post_id'      => 7,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
