<?php
    // 暗号化
    const AES_KEY = json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes-key"];
    const AES_IV= json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes-iv"];
        
    function encrypt($data){
        return $data === null ? null :
            openssl_encrypt($data, "AES-256-CBC", AES_KEY, 0, AES_IV);
    }

    function decrypt($data){
        return $data === null ? null :
            openssl_decrypt($data, "AES-256-CBC", AES_KEY, 0, AES_IV);
    }

    // ユーザーリストを取得
    $userlist = file_get_contents("../database/account/list.json");
    $userlist = mb_convert_encoding($userlist, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $userlist = json_decode($username,true);

    // パスワードがあってない、またはログインされてない場合はログイン画面へ
    try{
    if(
        $_COOKIE["password"] !== $userlist[$_COOKIE["username"]]["password"]
        ||
        $_COOKIE["login"] !== "true"
    ){
        header("Location:../login");
        exit();
    }else{
        echo "";
    }
    } catch(Exception){}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム | おうちネット</title>
</head>
<body>
    
</body>
</html>