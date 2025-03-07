<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function get_posts_data(): array
    {
        $sql  = 'SELECT *'.PHP_EOL;
        $sql .= 'FROM posts'.PHP_EOL;

        return DB::select($sql);
    }
}
