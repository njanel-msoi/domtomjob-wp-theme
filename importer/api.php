<?php
/* config variable to use the wpjb api */

// This key is an important secured info. Please keep it safe
define("API_ACCESS_TOKEN", '50d3c47d440db7cce46093821fe9b794e7a3d799');
define("API_CRYPT", '79b6582ecbbe64cf7b7e52966636293d');
define("API_CYPHER",        "aes-128-cbc");

$debug = str_contains($_SERVER['SERVER_NAME'], '.local') || str_contains($_SERVER['SERVER_NAME'], 'dev.');
define("API_DEBUG", true);

$protocol = 'http://';
if (
    isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
) {
    $protocol = 'https://';
}
$host = $protocol . $_SERVER['SERVER_NAME'];

// The 4 values below you can copy from wp-admin / Settings (WPJB) / REST API panel
define("API_URL_HOME",      "$host");
define("API_URL",           "$host/wpjobboard/api");

/** Methods to use the api */
function api_encrypt($key, $plaintext)
{
    return bin2hex(openssl_encrypt(
        $plaintext,
        API_CYPHER,
        $key,
        0,
        substr(hash('sha256', API_URL_HOME), 0, 16)
    ));
}

function set_headers($ch)
{
    $headers = array("X-Authorization: " . api_encrypt(API_CRYPT, API_ACCESS_TOKEN));

    curl_setopt($ch, CURLOPT_VERBOSE, API_DEBUG);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    return $ch;
}
function request($path, $method = 'POST', $body = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, API_URL . $path);

    set_headers($ch);

    if ($method == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
    }

    // return response
    $result = curl_exec($ch);

    curl_close($ch);


    return $result;
}
function post($path, $body)
{
    return request($path, 'POST', $body);
}

function postJob($job)
{
    return post('/jobs/', $job);
}
