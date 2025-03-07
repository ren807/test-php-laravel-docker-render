<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    public function get_posts_data(): array
    {
        $sql  = 'SELECT *'.PHP_EOL;
        $sql .= 'FROM posts'.PHP_EOL;

        return DB::select($sql);
    }
}
