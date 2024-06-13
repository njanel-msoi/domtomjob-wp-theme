<?php
include_once "config.php";
include_once "functions.php";

if (!isset($_POST['API_USER']) || !isset($_POST['API_PASS']))
    exit('need credentials');

extract($_POST);

if (defined("API_ACCESS_TOKEN") && API_ACCESS_TOKEN) {
    // access token already defined
    return;
}

// generate access token using username and password
$url = API_URL . '/api/accessToken/';

$headers = array(
    "X-Authorization: " . encrypt(API_CRYPT, $API_USER . ":" . $API_PASS),
    "X-Authorization-Type: AES"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_HEADER, API_DEBUG && $direct);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);

curl_close($ch);

$object = json_decode($result);

define("API_ACCESS_TOKEN", $object->access_token);
