<?php
    // 暗号化
    function encrypt($data){
        return $data === null ? null :
            openssl_encrypt($data, "AES-256-CBC", json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_key"], 0, json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_iv"]);
    }

    function decrypt($data){
        return $data === null ? null :
            openssl_decrypt($data, "AES-256-CBC", json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_key"], 0, json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_iv"]);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $user = $_POST["username"];
        $password = $_POST["password"];
        $message;
        $error = false;

        if($user === ""){
            $message = "ユーザー名を入力してください";
            $error = true;
            if($password === ""){
                $message = "ユーザー名・パスワードを入力してください";
                $error = true;
            }
        }else if($password === ""){
            $message = "パスワードを入力してください";
            $error = true;
        }else{
            // ユーザーリストを取得
            $userlist = file_get_contents("../database/account/list.json");
            $userlist = mb_convert_encoding($userlist, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
            $userlist = json_decode($userlist,true);

            // ログイン処理
            if($password === decrypt($userlist[$user]["password"])){
                // ログイン成功
                setcookie(
                    "username",
                    $user,
                    time() + (60 * 60 * 24 * 400), // 400日間有効
                    "/",
                    null,
                    true,
                    true,
                );
                setcookie(
                    "password",
                    urldecode(encrypt($password)),
                    time() + (60 * 60 * 24 * 400), // 400日間有効
                    "/",
                    null,
                    true,
                    true,
                );
                setcookie(
                    "login",
                    "true",
                    time() + (60 * 60 * 24 * 400), // 400日間有効
                    "/",
                    null,
                    true,
                    true,
                );
                
                echo "<script>location.href='../home'</script>";
                exit();
            }else{
                $message = "ユーザー名またはパスワードが間違っています。";
                $error = true;
            }
        }
    } else if(isset($_COOKIE["login"]) !== false){
        header("Location:../home");
        exit();
    }else{
        header("Location:./index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            if($error){
                echo "内容にエラーがあります | おうちネット";
            }
        ?>
    </title>
</head>
<body>
    <h1>内容にエラーがあります</h1>
    <p style="border-radius: 10px;background-color:red;width:250px;">エラー内容：<?php echo $message;?></p>
    <a href="index.php">ログイン画面に戻る</a>
</body>
</html>