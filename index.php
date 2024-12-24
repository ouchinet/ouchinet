<?php
    // ログインされていたらホームへ、ログインされていなかったらホーム
    try{
    if(isset($_COOKIE["username"])){
        header("Location:home/index.php");
        exit();
    }else{
        header("Location:login/index.php");
        exit();
    }
    }catch(Exception){
    }