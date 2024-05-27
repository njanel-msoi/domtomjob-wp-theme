<?php

header("Content-type: text/plain; charset=utf-8");

include_once "access-token.php";

$url = API_URL.'/api/alert/';
$headers = array("X-Authorization: ".encrypt(API_CRYPT, API_ACCESS_TOKEN));

$headers = array(
    "X-Authorization: ".base64_encode(API_ACCESS_TOKEN),
    "X-Authorization-Type: base64"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_VERBOSE, API_DEBUG);   
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    "email" => "",
    "frequency" => 0, // 0:instant/mobile, 1:email-daily, 2:email-weekly
    "params" => array(
        "keyword" => "test"
    )
)));


$result = curl_exec($ch);

curl_close($ch);

print_r($result);