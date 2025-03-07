<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $post;

    public function __construct()
    {
        $this->post = new Post(); // 投稿モデルをインスタンス化
    }

    public function index()
    {
        $data = $this->post->get_posts_data();
        dd($data);
    }
}
