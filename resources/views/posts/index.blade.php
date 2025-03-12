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
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post h2 {
            margin: 0;
            color: #007bff;
        }
        .post p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }
        .post img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>投稿一覧</h1>
        @foreach ($posts as $post)
            <div class="post">
                @if($post->image_url)
                    <img src="{{ $post->image_url }}" alt="画像">
                @endif
                <h2>{{ $post->shopname }}</h2>
                <p>評価: <strong>{{ number_format($post->avg_rating, 1) }}</strong> ⭐</p>
            </div>
        @endforeach
    </div>
</body>
</html>
