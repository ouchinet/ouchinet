<?php

    require "../database/usrutil.php";
    IsLogin();
    $iconurl = GetIcon();

    // 最新ポスト
    $post_num = file_get_contents("../database/post/post-number.txt");
    $post_num = intval($post_num);
    $post_num = $post_num - 1;

    if($post_num != -1){
    
    // 10件表示
    $posts = file_get_contents("../database/post/list.json");
    $posts = mb_convert_encoding($posts, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $posts = json_decode($posts,true);

    // ポスト処理
    $post_html = "<br>";
    for($count = 1; $count < 11;$count++){
        if($count > $post_num + 1){
            break;
        }

        // データ取得
        $user_id = $posts[strval($count)]["user"];
        $user_name = $userlist[$posts[strval($count)]["user"]]["name"];

        $post_value = $posts[strval($count)]["value"];
        $post_date = $posts[strval($count)]["date"];
        $post_like = intval($posts[strval($count)]["like"]);

        if($userlist[$user_id]["icon"] === "default"){
            $usericonurl = "/asset/gui/default-icon.png";
        }else{
            $usericonurl = "/database/account/icon/". $user_id . "." .$userlist[$user_id]["icon"];
        }

        $post_html = "<div class='post'><a href='/profile?p=" . $user_id . "'><img src='". $usericonurl ."' id='post_icon'><span id='name'>" . $user_name . "</span><span id='id'>@" . $user_id . "</span></a><p>" . $post_value . "</p><p id='like'>" . $post_like ."いいね</p></div>" . $post_html;
    }

    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム | おうちネット</title>
    <link rel="stylesheet" href="/home/style.css">
    <link rel="icon" href="/database/ouchinet.png" type="image/x-icon">
</head>
<body>
    <header>
        <a href="/profile?p=<?php echo $_COOKIE["username"];?>">
            <img src="
                <?php echo $iconurl;?>
            " style="border-radius: 100%;width: 5em;" title="プロフィール">
        </a>

        <a href="/home">
            <img src="/asset/gui/menu/home.png" style="border-radius: 100%;width: 5em;" title="ホーム">
        </a>

        <a href="/search">
            <img src="/asset/gui/menu/search.png" style="border-radius: 100%;width: 5em;" title="通知">
        </a>

        <a href="/notice">
            <img src="/asset/gui/menu/notice.png" style="border-radius: 100%;width: 5em;" title="通知">
        </a>

        <a href="/newpost">
            <img src="/asset/gui/menu/newpost.png" style="border-radius: 100%;width: 5em;" title="新規投稿">
        </a>
    </header>

    <h1>タイムライン<a style="margin-left: 5px;" href="javascript: location.reload()">↻</a></h1>
    <?php
        if($post_num === -1){
            echo "
                <p>まだ投稿がありません</p>
                <a href='/newpost' style='border: solid #008000 3px'>最初の投稿をする！</a>
            ";
        }else{
            echo $post_html;
        }
    ?>
</body>
</html>