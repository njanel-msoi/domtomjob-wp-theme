<?php

/** Methods to use the api */

include_once 'config.php';

function set_headers($ch)
{
    $headers = array("X-Authorization: " . encrypt(API_CRYPT, API_ACCESS_TOKEN));

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
    curl_setopt($ch, CURLOPT_URL, API_URL . $url);

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
