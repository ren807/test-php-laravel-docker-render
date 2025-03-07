<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
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
                'shopname'    => 'カフェABC',
                'tags'        => '2',
                'deleted_flg' => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'shopname'    => 'レストランXYZ',
                'tags'        => '0,1,2,3',
                'deleted_flg' => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'shopname'    => '居酒屋123',
                'tags'        => '0,1,2,3,4',
                'deleted_flg' => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
