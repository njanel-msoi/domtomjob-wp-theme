<?php

header("Content-type: text/plain; charset=utf-8");

include_once "access-token.php";

$url = API_URL.'/api/alert/8'; // <--- id to delete here
$headers = array("X-Authorization: ".encrypt(API_CRYPT, API_ACCESS_TOKEN));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, API_DEBUG);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

$result = curl_exec($ch);

curl_close($ch);

print_r($result);
