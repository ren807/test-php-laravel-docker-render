<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .post {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }
        .post-content {
            flex: 1;
        }
        .post h2 {
            margin: 0 0 5px;
            color: #007bff;
            font-size: 20px;
        }
        .post p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }
        /* タグのスタイル */
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 5px;
        }
        .tag {
            background-color: #007bff;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
        }
        /* いいね（ハート） */
        .likes {
            font-size: 18px;
            color: red;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        /* ページネーション */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a,
        .pagination span {
            margin: 0 5px;
            padding: 8px 12px;
            text-decoration: none;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
        }
        .pagination .active {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>投稿一覧</h1>
        @foreach ($posts['shopDetails'] as $post)
            <div class="post">
                @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="画像">
                @endif
                <div class="post-content">
                    <h2>{{ $post->shopname }}</h2>
                    <p>評価: <strong>{{ number_format($post->avg_rating, 1) }}</strong> ⭐</p>
                    
                    <!-- タグ表示 -->
                    @if (!empty($post->tags))
                        <div class="tags">
                            @foreach ($post->tags as $tag)
                                <span class="tag">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <!-- いいね（ハート）表示 -->
                    <p class="likes">❤️</p>
                </div>
            </div>
        @endforeach

        <!-- ページネーション -->
        <div class="pagination">
            @for ($i = 1; $i <= $posts['pagerInfo']['maxPage']; $i++)
                @if ($i == $posts['pagerInfo']['nowPage'])
                    <span class="active">{{ $i }}</span>
                @else
                    <a href="?page_id={{ $i }}">{{ $i }}</a>
                @endif
            @endfor
        </div>
    </div>
</body>
</html>
