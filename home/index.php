<?php
    // ここからログイン認証

    // 暗号化
    function encrypt($data){
        return $data === null ? null :
            openssl_encrypt($data, "AES-256-CBC", json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_key"], 0, json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_iv"]);
    }

    function decrypt($data){
        return $data === null ? null :
            openssl_decrypt($data, "AES-256-CBC", json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_key"], 0, json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_iv"]);
    }

    // ユーザーリストを取得
    $userlist = file_get_contents("../database/account/list.json");
    $userlist = mb_convert_encoding($userlist, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $userlist = json_decode($userlist,true);

    // パスワードがあってない、またはログインされてない場合はログイン画面へ
    try{
    if(decrypt(urldecode($_COOKIE["password"])) !== decrypt(urldecode($userlist[$_COOKIE["username"]]["password"]))){
        header("Location:../login");
        exit();
    }
    } catch(error){exit();}

    // アイコン処理
    if($userlist[$_COOKIE["username"]]["icon"] === "default"){
        $iconurl = "../asset/gui/default-icon.png";
    }else{
        $iconurl = "../database/account/icon/". $_COOKIE["username"] . "." .$userlist[$_COOKIE["username"]]["icon"];
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム | おうちネット</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="../database/ouchinet.png" type="image/x-icon">
</head>
<body>
    <div id="pc">
        <header>
        <a href="../profile?p=<?php echo $_COOKIE["username"];?>">
            <img src="
                <?php echo $iconurl;?>
            " style="border-radius: 100%;width: 5em;" title="プロフィール">
        </a>

        <a href="../home">
            <img src="../asset/gui/menu/home.png" style="border-radius: 100%;width: 5em;" title="ホーム">
        </a>

        <a href="../search">
            <img src="../asset/gui/menu/search.png" style="border-radius: 100%;width: 5em;" title="通知">
        </a>

        <a href="../notice">
            <img src="../asset/gui/menu/notice.png" style="border-radius: 100%;width: 5em;" title="通知">
        </a>
        </header>

        <h1>タイムライン</h1>
    </div>

    <div id="mobile" style="display:none">
    </div>
</body>
</html>