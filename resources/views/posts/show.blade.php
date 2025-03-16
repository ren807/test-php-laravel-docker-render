<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>投稿詳細</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
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
            max-width: 500px;
            margin: 0 auto;
        }
        .post {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post img {
            /* width: 100%; */
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .post h2 {
            color: #007bff;
            font-size: 24px;
        }
        .post p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 10px;
        }
        .tag {
            background-color: #007bff;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
        }
        .likes {
            font-size: 18px;
            color: red;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>投稿詳細</h1>
        <div class="post">
            @if(!empty($post['images']))
                <div class="slick-slider">
                    @foreach($post['images'] as $image)
                        <div><img src="{{ $image->image_url }}" alt="画像"></div>
                    @endforeach
                </div>
            @endif
            <h2>{{ $post['shopDetail']['shopname'] }}</h2>
            <p>評価: <strong>{{ number_format($post['shopDetail']['avg_rating'], 1) }}</strong> ⭐</p>
            <p>住所: {{ $post['shopDetail']['address'] }}</p>
            
            @if (!empty($post['shopDetail']->tags))
                <div class="tags">
                    @foreach ($post['shopDetail']->tags as $tag)
                        <span class="tag">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif

            <p class="likes">❤️</p>
        </div>
        <a href="/" class="back-link">一覧に戻る</a>
    </div>
</body>
</html>
