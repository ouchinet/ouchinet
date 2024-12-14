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
    <title>アカウント作成 | おうちネット</title>
</head>
<body>
    <form action="check.php" method="post">
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email">

        <br>

        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username">
        <p>
            ※半角英数字のみ。
            <br>
            3文字以上15文字以下の範囲です。
        </p>

        <br>

        <label for="username">パスワード:</label>
        <input type="password" id="password" name="password">
        <p>
            ※半角英数字・記号(- _ ! ?)のみ。
            <br>
            6文字以上15文字未満の範囲です。
        </p>

        <br>

        <label for="confirm_password">パスワード(確認):</label>
        <input type="password" id="confirm_password" name="confirm_password">

        <br>

        <label for="terms"><a href="../terms">利用規約に同意します:</a></label>
        <input type="checkbox" id="terms" name="terms">

        <br>

        <button type="submit">送信</button>

        <br>
        <a href="../password-reset">パスワードを忘れた</a>
        <br>
        <a href="../username-reset">ユーザー名を忘れた</a>
        <br>
        <a href="../login">ログイン</a>
    </form>
</body>
</html>