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
            width: 100%;
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
        .slick-slider div {
            text-align: center; /* スライドの中身を中央揃え */
        }
        .slick-slider img {
            display: block;
            margin: 0 auto;
            width: auto; /* 幅を自動調整 */
            max-width: 100%; /* コンテナの幅を超えないように */
            height: auto; /* 高さを自動調整 */
            max-height: 300px; /* 最大高さを300pxに制限 */
            object-fit: contain; /* 縦横比を維持して画像を表示 */
            border-radius: 8px;
        }
        .slick-prev, .slick-next {
            font-size: 0; /* デフォルトのテキストを非表示 */
            width: 40px;
            height: 40px;
            z-index: 1000;
        }
        .slick-prev::before, .slick-next::before {
            font-size: 30px;
            color: #007bff; /* 矢印の色を変更 */
            opacity: 1; /* デフォルトで見えるように */
        }
        .slick-prev:hover::before, .slick-next:hover::before {
            color: #0056b3; /* ホバー時に色を少し濃く */
        }
        .review {
            text-align: center;
        }
        .stars {
            display: flex;                /* フレックスボックスを使用 */
            justify-content: center;      /* 横方向で中央寄せ */
            align-items: center;          /* 縦方向で中央寄せ */
        }
        .stars span{
            display: flex;               /* 要素をフレックスボックスにする */
            flex-direction: row-reverse; /* 星を逆順に並べる */
            justify-content: flex-end;   /* 逆順なので、左寄せにする */
        }
        .stars input[type='radio']{
            display: none;               /* デフォルトのラジオボタンを非表示にする */
        }
        .stars label{
            color: #D2D2D2;              /* 未選択の星をグレー色に指定 */
            font-size: 30px;             /* 星の大きさを30pxに指定 */
            padding: 0 5px;              /* 左右の余白を5pxに指定 */
            cursor: pointer;             /* カーソルが上に乗ったときに指の形にする */
        }
        .stars label:hover,
        .stars label:hover ~ label,
        .stars input[type='radio']:checked ~ label{
            color: #F8C601;              /* 選択された星以降をすべて黄色にする */
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
        <a href="{{ route('index') }}" class="back-link">一覧に戻る</a>
    </div>
    <div class="review">
        <p>レビュー</p>
        <div class="stars">
            <span>
                <input id="review01" type="radio" name="review" value="5"><label for="review01">★</label>
                <input id="review02" type="radio" name="review" value="4"><label for="review02">★</label>
                <input id="review03" type="radio" name="review" value="3"><label for="review03">★</label>
                <input id="review04" type="radio" name="review" value="2"><label for="review04">★</label>
                <input id="review05" type="radio" name="review" value="1"><label for="review05">★</label>
                <input type="hidden" name="postId" value="{{ $post['shopDetail']['id'] }}">
            </span>
        </div>
    </div>
</body>
</html>
