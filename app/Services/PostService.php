<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * 店舗情報にタグ名を追加する
     * @return array<int, object>
     */
    public function getShopInfoWithTags(): array
    {
        // 店舗情報を取得する
        $shopInfo = $this->getShopInfo();

        // タグを全種類取得する
        $tags = $this->getAllTags();

        // タグ名を追加する処理
        foreach ($shopInfo as $si) {
            $tagIds = explode(',', $si->tags);

            // タグリストの初期化
            $tagList = [];

            foreach ($tagIds as $tagId) {
                if (isset($tags[$tagId])) {
                    $tagList[] = $tags[$tagId];
                }
            }

            $si->tags = $tagList;
        }

        return $shopInfo;
    }

    /**
     * 店舗情報を取得する
     * @return array<int, object>
     */
    private function getShopInfo(): array
    {
        $sql  = 'SELECT posts.id, posts.shopname, posts.tags, deleted_flg,'.PHP_EOL;
        $sql .= 'ROUND(AVG(rating)::numeric, 1) AS avg_rating, MAX(image_url) AS image_url'.PHP_EOL;
        $sql .= 'FROM posts'.PHP_EOL;
        $sql .= '   INNER JOIN ratings'.PHP_EOL;
        $sql .= '       ON posts.id = ratings.post_id'.PHP_EOL;
        $sql .= '   INNER JOIN images'.PHP_EOL;
        $sql .= '       ON posts.id = images.post_id'.PHP_EOL;
        $sql .= 'GROUP BY posts.id, posts.shopname, posts.tags, posts.deleted_flg'.PHP_EOL;
        $sql .= 'ORDER BY avg_rating DESC'.PHP_EOL;

        return DB::select($sql);
    }

    /**
     * タグを全て取得する
     * @return array<int, object>
     */
    private function getAllTags(): array
    {
        $sql  = 'SELECT id, name'.PHP_EOL;
        $sql .= 'FROM tags'.PHP_EOL;

        return  DB::select($sql);
    }
}
