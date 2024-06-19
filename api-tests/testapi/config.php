<?php
$debug = str_contains($_SERVER['SERVER_NAME'], '.local') || str_contains($_SERVER['SERVER_NAME'], 'dev.');

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
define("API_URL",           "$host/wpjobboard");
define("API_CYPHER",        "aes-128-cbc");
define("API_CRYPT",         "79b6582ecbbe64cf7b7e52966636293d");

// Login and password of a user
define("API_USER",          "rest-api");
define("API_PASS",          "Mv7yp)CWX)7vBV%esWHdUxOW");

// or user access token
define("API_ACCESS_TOKEN",  "50d3c47d440db7cce46093821fe9b794e7a3d799");

// Enable debugging
define("API_DEBUG", true);

define("JOB_EXPIRATION", strtotime("today +30 day"));
