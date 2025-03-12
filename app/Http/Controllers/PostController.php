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
        $posts = $this->post->getShopInfoWithTags();
        // dd($posts);

        return View('posts.index', ['posts' => $posts]);
    }
}
