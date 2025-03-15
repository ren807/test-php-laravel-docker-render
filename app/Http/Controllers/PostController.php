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
        
        $shopDetails = $this->post->getShopData();
        $favorites   = $this->post->getFavorites($userId);
        $pagerInfo     = $this->post->getPagerInfo();
        
        $posts = [
            'shopDetails' => $shopDetails,
            'favorites'   => $favorites,
            'pagerInfo'   => $pagerInfo,
        ];

        return View('posts.index', ['posts' => $posts]);
    }

    public function show()
    {
        $id = 1;
        $post = $this->post->getShopDetail($id);
        dd($post);
        return View('posts.show');
    }
}
