<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set("Asia/Tokyo");

    $value = htmlspecialchars($_POST["text"]);
    $value = str_replace("\n", "<br>",$value);

    if(mb_strlen($value,"UTF-8") == 0) {
        ob_end_clean();
        header("Content-Type: application/json");
        echo json_encode("エラー:投稿内容を入力してください");
        exit();
    }

    if(mb_strlen($value,"UTF-8") > 140) {
        ob_end_clean();
        header("Content-Type: application/json");
        echo json_encode("エラー:投稿内容は140文字以内、3文字以上で入力してください");
        exit();
    }

    if(mb_strlen($value,"UTF-8") < 3) {
        ob_end_clean();
        header("Content-Type: application/json");
        echo json_encode("エラー:投稿内容は140文字以内、3文字以上で入力してください");
        exit();
    }

    $postlist = file_get_contents("../database/post/list.json");
    $postlist = mb_convert_encoding($postlist, "UTF8", "ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN");
    $postlist = json_decode($postlist,true);

    $post_num = file_get_contents("../database/post/post-number.txt");

    $user = $_COOKIE["username"];

    $post_num = intval($post_num) + 1;

    $postlist[strval(value: $post_num)] = array(
        "value" => $value,
        "date" => date("Y-m-d"),
        "time" => date("H:i"),
        "user" => $user,
        "like" => 0,
        "reply" => []
    );

    file_put_contents("../database/post/list.json", preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($matches) {
        return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UTF-16");
    }, json_encode($postlist, JSON_PRETTY_PRINT)));
    file_put_contents("../database/post/post-number.txt", $post_num);

    $userlist = file_get_contents("../database/account/list.json");
    $userlist = mb_convert_encoding($userlist, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $userlist = json_decode($userlist,true);

    $userlist[$user]["post"] = $userlist[$user]["post"] + 1;

    file_put_contents("../database/account/list.json", preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($matches) {
        return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UTF-16");
    }, json_encode($userlist, JSON_PRETTY_PRINT)));

    ob_end_clean();
    header("Content-Type: application/json");
    echo json_encode("投稿しました");
}else{
    ob_end_clean();
    header("Location: ./index.php");
}