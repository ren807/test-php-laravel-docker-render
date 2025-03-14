<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;

    public function __construct(PostService $post_service, Request $request)
    {
        $this->post = $post_service;
        $this->post->setPagerInfo($request->input('page_id'));
    }

    public function index()
    {
        $userId = 1;
        $posts = [];

        $shopDetails = $this->post->getShopDetails();
        $favorites   = $this->post->getFavorites($userId);
        $pagerInfo     = $this->post->getPagerInfo();

        $posts = [
            'shopDetails' => $shopDetails,
            'favorites'   => $favorites,
            'pagerInfo'   => $pagerInfo,
        ];

        return View('posts.index', ['posts' => $posts]);
    }
}
