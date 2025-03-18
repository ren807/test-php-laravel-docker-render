<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class PostService
{
    private $maxPage; // 最大ページ数
    private $nowPage; // 現在のページ番号

    /**
     * ページャー情報をセットする
     */
    public function setPagerInfo($pageId) {
        $this->nowPage = $pageId;
    }

    /**
     * ページャーの情報を返す
     */
    public function getPagerInfo() {
        return ['maxPage' => $this->maxPage, 'nowPage' => $this->nowPage];
    }

    /**
     * 店舗一覧情報をView用に変換する
     * @return array<int, object>
     */
    public function convShopData(): array
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

    public function convShopDetailData($shopId)
    {
        // 店舗詳細情報を取得する
        $shopDetail = $this->getShopDetail($shopId);
        
        // タグを全種類取得する
        $tags = $this->getAllTags();
        
        // 以下、タグ名を追加する処理
        $tagIds = explode(',', $shopDetail['tags']);

        // タグリストの初期化
        $tagList = [];

        foreach ($tagIds as $tagId) {
            if (isset($tags[$tagId])) {
                $tagList = $tags[$tagId];
            }
        }
        
        $shopDetail['tags'] = $tagList;

        return $shopDetail;
    }

    /**
     * 店舗情報をDBから取得する
     * @return array<int, object>
     */
    public function getShopInfo(): array
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

        return $this->pager(DB::select($sql));
    }

    /**
     * タグを全て取得する
     * @return array<int, object>
     */
    public function getAllTags(): array
    {
        $sql  = 'SELECT id, name'.PHP_EOL;
        $sql .= 'FROM tags'.PHP_EOL;

        return  DB::select($sql);
    }

    /**
     * ユーザーがお気に入り（いいね）した投稿の post_id を取得する
     * @param int $user_id
     * @return array ユーザーが良いねした投稿のidリスト
     */
    public function getFavorites(int $user_id): array
    {
        $sql  = 'SELECT Favorites.post_id'.PHP_EOL;
        $sql .= '   FROM Favorites'.PHP_EOL;
        $sql .= 'WHERE user_id = :user_id'.PHP_EOL;

        return DB::select($sql, ['user_id' => $user_id]);
    }

    /**
     * 投稿一覧ページのページャー
     * @param array $shopData
     * @return array 表示用データ
     */
    private function pager(array $shopData): array
    {
        $max = 10; // 1ページの最大表示件数

        $shopNum = count($shopData); // 現在の合計店舗数

        $this->maxPage = ceil($shopNum / $max); // 最大ページ数
        
        if (!isset($this->nowPage)) {
            $this->nowPage = 1; // 特に指定されていなければ1ページ目を取得する
        }

        $startNo = ($this->nowPage - 1) * $max; // 開始ページ番号を取得する

        $dispData = array_slice($shopData, $startNo, $max, true);

        return $dispData;
    }

    /**
     * 店舗詳細を取得
     * @param $shopId 店舗id
     * @return array 店舗情報
     */
    public function getShopDetail(int $shopId)
    {
        $sql  = 'SELECT posts.id, posts.shopname, posts.tags,'.PHP_EOL;
        $sql .= 'ROUND(AVG(rating)::numeric, 1) AS avg_rating, post_details.address'.PHP_EOL;
        $sql .= 'FROM posts'.PHP_EOL;
        $sql .= '   INNER JOIN ratings'.PHP_EOL;
        $sql .= '       ON posts.id = ratings.post_id'.PHP_EOL;
        $sql .= '   INNER JOIN post_details'.PHP_EOL;
        $sql .= '       ON posts.id = post_details.post_id'.PHP_EOL;
        $sql .=     'WHERE posts.id = :shopId'.PHP_EOL;
        $sql .= 'GROUP BY posts.id, posts.shopname, posts.tags, posts.deleted_flg, post_details.address'.PHP_EOL;
        $sql .= 'ORDER BY avg_rating DESC'.PHP_EOL;

        $result = DB::select($sql, ['shopId' => $shopId]);

        return !empty($result) ? (array) current($result) : [];
    }

    public function getShopImages($shopId)
    {
        $sql  = 'SELECT images.image_url'.PHP_EOL;
        $sql .= 'FROM posts'.PHP_EOL;
        $sql .= '    INNER JOIN images'.PHP_EOL;
        $sql .= '    ON posts.id = images.post_id'.PHP_EOL;
        $sql .= '   WHERE posts.id = :shopId'.PHP_EOL;

        return DB::select($sql, ['shopId' => $shopId]);
    }

    public function getRating(int $userId, int $postId)
    {
        $sql  = 'SELECT * FROM ratings'.PHP_EOL;
	    $sql .= 'WHERE user_id = :userId AND post_id = :postId'.PHP_EOL;

        $params = [
            'userId' => $userId,
            'postId' => $postId,
        ];

        $result = DB::select($sql, $params);

        return !empty($result) ? (array) current($result) : [];
    }

    public function storeReview(int $userId, int $postId, int $rating)
    {
        $sql  = 'INSERT INTO ratings'.PHP_EOL;
        $sql .= '(user_id, post_id, rating, created_at, updated_at)'.PHP_EOL;
        $sql .= 'VALUES (:userId, :postId, :rating, NOW(), NOW())'.PHP_EOL;

        $params = [
            'userId' => $userId,
            'postId' => $postId,
            'rating' => $rating
        ];

        DB::insert($sql, $params);
    }

    public function updateReview(int $userId, int $postId, int $rating)
    {
        $sql  = 'UPDATE ratings SET rating = :rating'.PHP_EOL;
        $sql .= 'WHERE user_id = :userId AND post_id = :postId'.PHP_EOL;

        $params = [
            'userId' => $userId,
            'postId' => $postId,
            'rating' => $rating        
        ];

        DB::update($sql, $params);
    }
}
