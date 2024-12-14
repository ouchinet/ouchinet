<?php
    // 既にログインされていたらホームへ移動
    if(isset($_COOKIE["login"]) !== false){
        header("Location:../home");
        exit();
    }
    if(isset($_COOKIE["login"])){
        if($_COOKIE["login"] === "true"){
            header("Location:../home");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン | おうちネット</title>
    <link rel="icon" href="../database/ouchinet.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="../database/ouchinet.png" style="border-radius: 100%;width: 5em;">
    <h1>ログイン</h1>
    <form action="check.php" method="post">
        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username">

        <br>

        <label for="username">パスワード:</label>
        <input type="password" id="password" name="password">

        <br>

        <button type="submit">送信</button>
        <br>
        <a href="../password-reset">パスワードを忘れた</a>
        <a href="../username-reset">ユーザー名を忘れた</a>
        <br>
        <a href="../account-create"><p style="margin-top: 10px">アカウント作成</p></a>
    </form>
</body>
</html>