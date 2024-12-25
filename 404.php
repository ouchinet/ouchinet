<?php
    require "database/usrutil.php";
    try{
    if(IsLogin_Bool($_COOKIE["username"], $_COOKIE["password"])){
        $message = "ログインされていません。<br><a href='../login'>ログイン</a>";
    }else{
        $message = "ログインされています。";
    }
    } catch(error){exit();}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お探しのページが見つかりませんでした | おうちネット</title>
    <link rel="stylesheet" href="404.css">
</head>
<body>
    <h1>お探しのページが見つかりませんでした。</h1>
    <p>あなたは、<?php echo $message;?></p>
</body>
</html>