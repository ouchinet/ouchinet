<?php
    // 先にログインデータがあるか聞く
    if(isset($_COOKIE["login"]) === false){
        header("Location:../login");
        exit();
    }

    // 暗号化
    const AES_KEY = "sdzjkfsl_key";
    const AES_IV= "sdzjkfsl_iv";
        
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
    $userlist = json_decode($json);

    // パスワードがあってない、またはログインされてない場合はログイン画面へ
    if(
        $_COOKIE["password"] !== decrypt($userlist-> $_COOKIE["username"]->$_COOKIE["password"])
        ||
        $_COOKIE["login"]!== true
    ){
        header("Location:../login");
        exit();
    }
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