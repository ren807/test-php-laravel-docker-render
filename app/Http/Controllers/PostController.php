<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;

    public function __construct(PostService $post_service)
    {
        $this->post = $post_service;
    }

    public function index(Request $request)
    {
        $userId = 1;
        $this->post->setPagerInfo($request->input('page_id'));
        
        $shopData = $this->post->convShopData();
        $favorites   = $this->post->getFavorites($userId);
        $pagerInfo     = $this->post->getPagerInfo();

        $posts = [
            'shopData' => $shopData,
            'favorites'   => $favorites,
            'pagerInfo'   => $pagerInfo,
        ];

        return View('posts.index', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        $shopDetail = $this->post->convShopDetailData($id);
        $images = $this->post->getShopImages($id);

        $post = [
            'shopDetail' => $shopDetail,
            'images'     => $images,
        ];

        return View('posts.show', ['post' => $post]);
    }

    public function eval()
    {
        $userId = 4;
        $postId = request()->post('postId');
        $rating = request()->post('rating');
        
        // 以下、ログインユーザがすでに評価しているか確認する
        $shopRating = $this->post->getRating($userId, $postId);

        if (empty($shopRating)) {
            $this->post->storeReview($userId, $postId, $rating); // 未評価の場合、新たにDBに追加する
        } else {
            $this->post->updateReview($userId, $postId, $rating); // 評価済みの場合、DBを更新する
        }

        $data = [
            'postId' => $postId,
            'rating' => $rating,
            'shopRating' => $shopRating,
        ];

        return response()->json($data);
    }
}
