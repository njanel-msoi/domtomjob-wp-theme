<?php

header("Content-type: text/plain; charset=utf-8");

include_once "access-token.php";

$url = API_URL.'/api/applications/46';
$headers = array("X-Authorization: ".encrypt(API_CRYPT, API_ACCESS_TOKEN));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_VERBOSE, API_DEBUG);   
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    "status" => "3",
)));


$result = curl_exec($ch);

print_r(curl_getinfo($ch, CURLINFO_HEADER_OUT ));

curl_close($ch);

print_r($result);