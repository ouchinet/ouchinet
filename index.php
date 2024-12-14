<?php
    // ログインされていたらホームへ、ログインされていなかったらホーム
    if(isset($_COOKIE["login"])){
        header("Location:home/index.php");
        exit();
    }else{
        header("Location:login/index.php");
        exit();
    }