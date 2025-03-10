<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * 店舗ごとの平均評価値を取得する
     * @return array<int, object>
     */
    public function getAverageRating(): array
    {
        $sql  = 'SELECT shopname, AVG(rating) AS 平均値'.PHP_EOL;
        $sql .= 'FROM posts'.PHP_EOL;
        $sql .= '   INNER JOIN ratings'.PHP_EOL;
        $sql .= '   ON posts.id = ratings.post_id'.PHP_EOL;
        $sql .= 'GROUP BY posts.id, posts.shopname'.PHP_EOL;
        $sql .= 'ORDER BY 平均値 DESC'.PHP_EOL;

        return $this->formatAverageRatings(DB::select($sql));
    }

    /**
     * 平均評価の値を小数第1位に丸める
     * @param array<int, object>
     * @return array<int, object>
     */
    private function formatAverageRatings(array $results): array
    {
        foreach ($results as $result) {
            $result->平均値 = round($result->平均値, 1);
        }
    
        return $results;
    }
}
