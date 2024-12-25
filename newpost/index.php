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
        header("Location:/login");
        exit();
    }
    } catch(error){exit();}

    // アイコン処理
    if($userlist[$_COOKIE["username"]]["icon"] === "default"){
        $iconurl = "/asset/gui/default-icon.png";
    }else{
        $iconurl = "/database/account/icon/". $_COOKIE["username"] . "." .$userlist[$_COOKIE["username"]]["icon"];
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポストを作成 | おうちネット</title>
    <link rel="stylesheet" href="/newpost/style.css">
    <link rel="icon" href="/database/ouchinet.png" type="image/x-icon">
</head>
<body>
    <a id="back" href="javascript:back()">←</a>
    <form>
        <img src="<?php echo $iconurl; ?>" alt="あなたのアイコン" style="width: 5em;border-radius: 100%;">
        <textarea name="text" placeholder="どんなことがあった？" id="text" required></textarea>
        <input type="submit" value="投稿する" id="submit">
    </form>

    <div class="message"></div>

    <script src="/newpost/script.js"></script>
</body>
</html>