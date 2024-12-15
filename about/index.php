<?php
    $version = file_get_contents("../database/version");
    $servername = json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["server-name"];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>おうちネットについて | おうちネット</title>
    <link rel="icon" href="../database/ouchinet.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="../database/ouchinet.png" style="border-radius: 100%;width: 5em;">
    <h1>おうちネットとは</h1>
    <p>
        おうちネットとは家庭などでで気軽に使える小規模向けSNSです。
        <br>
        分散型と似ていますがおうちネット同士では投稿を同期しなく、個別でのみデータを保管します。
        <br>
    </p>
    <h1>このおうちネットについて</h1>
    <p>
        このおうちネットのサーバ名は「<?php echo $servername?>」です。
        <br>
        このおうちネットのバージョンは「<?php echo $version?>」です。
        <br>
        詳細は<a href="https://github.com/webfullsympathy/ouchinet/releases">GitHubのリリース</a>からご確認ください。
    </p>
    </body>
</body>
</html>