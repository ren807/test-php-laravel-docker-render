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

    public function show()
    {
        $id = 10;
        $shopDetail = $this->post->convShopDetailData($id);
        $images = $this->post->getShopImages($id);

        $post = [
            'shopDetail' => $shopDetail,
            'images'     => $images,
        ];

        return View('posts.show', ['post' => $post]);
    }
}
