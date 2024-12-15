<?php
    // 暗号化です。パスワード等の一部のデータはこのPHPコードを使用してください。
    function encrypt($data){
        return $data === null ? null :
            openssl_encrypt($data, "AES-256-CBC", json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_key"], 0, json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_iv"]);
    }

    function decrypt($data){
        return $data === null ? null :
            openssl_decrypt($data, "AES-256-CBC", json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_key"], 0, json_decode(mb_convert_encoding(file_get_contents("../database/config.json"), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'),true)["aes_iv"]);
    }
?>