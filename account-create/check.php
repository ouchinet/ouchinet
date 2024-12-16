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
        $email = $_POST["email"];
        $user = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
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
        }elseif($email === ""){
            $message = "メールアドレスを入力してください";
            $error = true;
        }else{
            // ユーザーリストを取得
            $userlist = file_get_contents("../database/account/list.json");
            $userlist = mb_convert_encoding($userlist, "UTF8", "ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN");
            $userlist = json_decode($userlist,true);

            // アカウント作成処理
            if(mb_strlen($user, "UTF-8") < 3 || mb_strlen($user, "UTF-8") > 15){
                $message = "ユーザー名は3文字以上15文字以下で入力してください";
                $error = true;
                if (preg_match("/^[a-zA-Z0-9]/", $user)) {
                    $message = "ユーザー名は3文字以上15文字以下で入力してください。<br>また、ユーザー名は半角英数字で入力してください";
                    $error = true;
                }
            }
            if (preg_match("/^[a-zA-Z0-9]/", $user) === false) {
                $message = "ユーザー名は3文字以上15文字以下で入力してください。<br>また、ユーザー名は半角英数字で入力してください";
                $error = true;
            }
            

            if (preg_match("/^[a-zA-Z0-9-_!\?]*$/", $password) === false || mb_strlen($password, "UTF-8") < 6 || mb_strlen($password,"UTF-8") > 15){
                $message = "パスワードは半角英数字と記号(!?-_)、6~15文字で入力してください";
                $error = true;
            }

            if($password !== $confirm_password){
                $message = "パスワードと確認用パスワードが一致しません";
                $error = true;
            }

            if($error === false){
                $userlist[$user] = [
                    "name" => urlencode($user),
                    "email" => urlencode($email),
                    "password" => urlencode(encrypt($password)),
                    "icon" => "default"
                ];

                file_put_contents("../database/account/list.json", json_encode($userlist, JSON_PRETTY_PRINT));

                header("Location:../login");
                exit();
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
    <a href="index.php">アカウント作成画面に戻る</a>
</body>
</html>