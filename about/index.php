<?php
    $version = file_get_contents("../database/version");
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
        このおうちネットのバージョンは<?php echo $version?>です。
        <br>
        詳細はGitHubのリリースからご確認ください。
    </p>
</body>
</html>