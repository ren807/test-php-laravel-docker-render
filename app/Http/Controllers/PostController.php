<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $post;
    private $userId = 4;
    const STORE_CONFIRM  = "confirm";
    const STORE_COMPLETE = "complete";

    public function __construct(PostService $post_service)
    {
        $this->post = $post_service;
    }

    public function index(Request $request)
    {
        $this->post->setPagerInfo($request->input('page_id'));
        
        $shopData = $this->post->convShopData();
        $favorites   = $this->post->getFavorites($this->userId);
        $pagerInfo     = $this->post->getPagerInfo();

        $data = [
            'shopData'    => $shopData,
            'favorites'   => $favorites,
            'pagerInfo'   => $pagerInfo
        ];

        return View('posts.index', $data);
    }

    public function create()
    {
        $tags = $this->post->getAllTags();
        return View('posts.create', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        $inputData         = $request->all();
        $inputData['tags'] = implode(',', $inputData['tags']);

        // 確認画面に遷移
        if (!empty($inputData["confirm"]) && $inputData["confirm"] === self::STORE_CONFIRM) {

            $tags = $this->post->getAllTags();
            $convTags = $this->post->convTagsData($inputData['tags'], $tags);

            $data = [
                'inputData' => $inputData,
                'tags'      => $convTags,
            ];

            return View('posts.confirm', $data);
        }

        // 登録完了画面に遷移
        if (!empty($inputData["complete"]) && $inputData["complete"] === self::STORE_COMPLETE) {

            DB::transaction(function () use ($inputData) {
                // postsテーブルに登録
                $this->post->insertPosts($inputData['shopname'], $inputData['tags']);
        
                // postsテーブルに登録したデータのidを取得
                $maxId = $this->post->getShopByMaxId();
        
                // posts_detailテーブルに登録
                $this->post->insertPostDetail($inputData['address'], $maxId['shopid']);
            });

            return View('posts.complete');
        }
    }

    public function show(int $id)
    {
        $shopDetail = $this->post->convShopDetailData($id);
        $images = $this->post->getShopImages($id);

        $data = [
            'shopDetail' => $shopDetail,
            'images'     => $images,
        ];

        return View('posts.show', $data);
    }

    public function eval()
    {
        $postId = request()->post('postId');
        $rating = request()->post('rating');
        
        // 以下、ログインユーザがすでに評価しているか確認する
        $shopRating = $this->post->getRating($this->userId, $postId);

        if (empty($shopRating)) {
            $this->post->storeReview($this->userId, $postId, $rating); // 未評価の場合、新たにDBに追加する
        } else {
            $this->post->updateReview($this->userId, $postId, $rating); // 評価済みの場合、DBを更新する
        }

        $data = [
            'postId' => $postId,
            'rating' => $rating,
            'shopRating' => $shopRating,
        ];

        return response()->json($data);
    }
}
