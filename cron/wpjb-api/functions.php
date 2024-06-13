<?php

function encrypt_old($key, $plaintext)
{
    //$iv = 'fedcba9876543210';
    //$key = '0123456789abcdef';

    $iv = substr(hash('sha256', API_URL_HOME), 0, 16);

    $td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

    mcrypt_generic_init($td, $key, $iv);
    $encrypted = mcrypt_generic($td, $plaintext);

    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    return bin2hex($encrypted);
}

function encrypt($key, $plaintext)
{
    return bin2hex(openssl_encrypt(
        $plaintext,
        API_CYPHER,
        $key,
        0,
        substr(hash('sha256', API_URL_HOME), 0, 16)
    ));
}

function exec_curl_request($apiPath, $postBody = null)
{
    include_once "access-token.php";

    $url = API_URL . $apiPath;
    $headers = array("X-Authorization: " . encrypt(API_CRYPT, API_ACCESS_TOKEN));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, API_DEBUG);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($postBody) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postBody));
    }

    $result = curl_exec($ch);
    curl_close($ch);

    header("Content-type: text/plain; charset=utf-8");
    print_r($result);

    return $result;
}
