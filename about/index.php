<?php
// バージョン情報を取得
$version = file_get_contents("/database/version");
$version = htmlspecialchars($version ?: "不明", ENT_QUOTES, 'UTF-8');

// サーバー名を取得
$configFile = "/database/config.json";
$serverName = "不明";
if (file_exists($configFile)) {
    $configContent = file_get_contents($configFile);
    $config = json_decode(mb_convert_encoding($configContent, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'), true);
    $serverName = htmlspecialchars($config["server-name"] ?? "不明", ENT_QUOTES, 'UTF-8');
}
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
<header>
    <h1>OUCHINET</h1>
    <p><?php echo $serverName;?></p>
    <p>大切な人とつながる、あたたかいSNS</p>
    <div class="version-info">
        v <?php echo $version; ?>
    </div>
</header>
<section class="hero">
    <div class="container">
        <h1>家族の<span>思い出</span>をもっと身近に</h1>
        <p>家族みんなで使えるシンプルで安心なSNS。 写真や文章を簡単に共有し、大切な思い出をいつでも振り返ることができます。</p>
    </div>
</section>
<section class="family-space animate-on-scroll">
    <div class="content">
        <h2>安心して使える、<br>家族のための空間</h2>
        <p>
            安心のプライバシー設定で、誰もが安心して利用可能。
            プライベート空間で、あなたの大切な思い出を守ります。
        </p>
        <ul class="features">
            <li>安全な環境</li>
            <li>簡単な操作性</li>
            <li>データの永久保存</li>
        </ul>
    </div>
    <div class="background-box"></div>
</section>
<div style="text-align: center;"><span>Powered by Ouchinet</span></div>
</body>
</html>