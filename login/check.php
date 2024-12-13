<?php 
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
            }else{
                echo "";
            }
        ?>
    </title>
</head>
<body>
    
</body>
</html>