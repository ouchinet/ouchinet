<?php
    // 既にログインされていたらホームへ移動
    if(isset($_COOKIE["login"]) !== false){
        header("Location:../home");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン | おうちネット</title>
</head>
<body>
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
        <a href="../account-create">アカウントを作成</a>
    </form>
</body>
</html>