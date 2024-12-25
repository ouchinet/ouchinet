<?php
    if(isset($_GET["p"])){
        // ここからログイン認証
        // +アイコン処理
        require "../database/usrutil.php";
        IsLogin();
        $iconurl = GetIcon();

        $user = $_GET["p"];

        if($user === ""){
            header("Location: /home");
            exit();
        }

        if(isset($userlist[$user]) === false){
            $message = "ユーザーが見つかりませんでした";
        }else{
            // ユーザー情報取得

            $name = $userlist[$user]["name"];
            $bio = $userlist[$user]["bio"];
            $follow = count($userlist[$user]["follow"]);
            $follower = count($userlist[$user]["follower"]);
            $post = $userlist[$user]["post"];

            if($userlist[$user]["icon"] === "default"){
                $usericonurl = "/asset/gui/default-icon.png";
            }else{
                $usericonurl = "/database/account/icon/". $user . "." .$userlist[$user]["icon"];
            }
        }
    }else{
        if($user === ""){
            header("Location: ../home");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム | おうちネット</title>
    <link rel="stylesheet" href="/profile/style.css">
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

    <?php
        if(isset($message)){
            echo $message;
        }else{
            echo "
                <div id='profile'>
                    <img src='$usericonurl' id='icon'>

                    <br>

                    <span id='name'>$name</span>
                    <span id='id'>@$user</span>

                    <br>

                    <span id='bio'>$bio<br></span>

                    <br>

                    <span id='follow'><span style='font-weight:bold'>$follow</span>フォロー</span>
                    <span id='follower'><span style='font-weight:bold'>$follower</span>フォロワー</span>
                    <span id='post'><span style='font-weight:bold'>$post</span>投稿</span>
                </div>
            ";
        }
    ?>
</body>
</html>