<?php
include_once "config.php";
include_once "functions.php";

echo 'Token to get accesstoken<br><textarea>' . encrypt(API_CRYPT, API_USER . ":" . API_PASS) . '</textarea><br><br>';

if (defined("API_ACCESS_TOKEN") && API_ACCESS_TOKEN) {
    // access token already defined

    echo 'AccessToken for requests<br><textarea>' . encrypt(API_CRYPT, API_ACCESS_TOKEN) . '</textarea>';
    return;
}

// generate access token using username and password

$url = API_URL . '/api/accessToken/';

$headers = array(
    "X-Authorization: " . encrypt(API_CRYPT, API_USER . ":" . API_PASS),
    "X-Authorization-Type: AES"
);

$headersX = array(
    "X-Authorization: " . base64_encode(API_USER . ":" . API_PASS),
    "X-Authorization-Type: base64"
);


$b1 = basename(__FILE__);
$b2 = basename($_SERVER["SCRIPT_FILENAME"]);

$direct = $b1 == $b2;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, API_DEBUG && $direct);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


$result = curl_exec($ch);

curl_close($ch);

$object = json_decode($result);

if ($direct) {
    print_r($result);
} else {
    define("API_ACCESS_TOKEN", $object->access_token);
}
