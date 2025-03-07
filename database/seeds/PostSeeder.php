<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'shopname' => 'カフェABC',
                'deleted_flg' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shopname' => 'レストランXYZ',
                'deleted_flg' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'shopname' => 'バー123',
                'deleted_flg' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
