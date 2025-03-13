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

    public function index()
    {
        $id = 1;
        $posts = [];

        $shopDetails = $this->post->getShopDetails();
        $Favorites   = $this->post->getFavorites($id);

        $posts = [
            'shopDetails' => $shopDetails,
            'Favorites'   => $Favorites
        ];

        return View('posts.index', ['posts' => $posts]);
    }
}
