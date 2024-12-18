<?php
    if(isset($_GET["p"])){
      $post_id = $_GET["p"];
    }else{
      header("Location: ../home");
      exit();
    }
