<?php
    // ここからログイン認証
    // +アイコン処理
    require "../database/usrutil.php";
    IsLogin();
    $iconurl = GetIcon();
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