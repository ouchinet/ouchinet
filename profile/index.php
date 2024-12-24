<?php
if(isset($_GET["user"])){
    $user = $_GET["p"];

    if($user === ""){
        if(isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }else{
            header("Location: ../");
            exit();
        }
    }

    $userlist = file_get_contents("../database/account/list.json");
    $userlist = mb_convert_encoding($userlist, "UTF8", "ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN");
    $userlist = json_decode($userlist,true);

    if(isset($userlist[$user]) === false){
        $message = "お探しのユーザーが見つかりませんでした";
    }else{
        $name = $userlist[$user]["name"];
        // その他色々取得
    }
}else{
    if(isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }else{
        header("Location: ../home");
        exit();
    }
}