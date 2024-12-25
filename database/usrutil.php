<?php
require "encrypt.php";

// ユーザーリストを取得
$userlist = file_get_contents("../database/account/list.json");
$userlist = mb_convert_encoding($userlist, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$userlist = json_decode($userlist,true);

function IsLogin(){
    // パスワードがあってない、またはログインされてない場合はログイン画面へ
    global $userlist;
    try{
        if(decrypt(urldecode($_COOKIE["password"])) !== decrypt(urldecode($userlist[$_COOKIE["username"]]["password"]))){
            header("Location:/login");
            exit();
        }
    } catch(error){exit();}
};
function GetIcon(){
    global $userlist;
    if($userlist[$_COOKIE["username"]]["icon"] === "default"){
        $iconurl = "/asset/gui/default-icon.png";
    }else{
        $iconurl = "/database/account/icon/". $_COOKIE["username"] . "." .$userlist[$_COOKIE["username"]]["icon"];
    }
    return $iconurl;
}
