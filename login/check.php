<?php
    require "../database/usrutil.php";

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
            // ログイン処理
            if(IsLogin_Bool($user, $password)){
                // ログイン成功
                setcookie(
                    "username",
                    urlencode($user),
                    time() + (60 * 60 * 24 * 400), // 400日間有効
                    "/",
                    null,
                    true,
                    true,
                );
                setcookie(
                    "password",
                    $password,
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
                
                header("Location:/home");
                exit();
            }else{
                $message = "ユーザー名またはパスワードが間違っています。";
                $error = true;
            }
        }
    } else if(isset($_COOKIE["login"]) !== false){
        header("Location:/home");
        exit();
    }else{
        header("Location:/index.php");
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
    <a href="/login">ログイン画面に戻る</a>
</body>
</html>