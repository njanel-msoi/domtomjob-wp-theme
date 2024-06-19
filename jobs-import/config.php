<?php
/* config variable to use the wpjb api */

// This key is an important secured info. Please keep it safe
define("API_ACCESS_TOKEN", '50d3c47d440db7cce46093821fe9b794e7a3d799');
define("API_CRYPT", '79b6582ecbbe64cf7b7e52966636293d');
define("JOB_EXPIRATION", strtotime("today +60 day"));

define("POST_JOB_PATH","")

$debug = str_contains($_SERVER['SERVER_NAME'], '.local') || str_contains($_SERVER['SERVER_NAME'], 'dev.');
define("API_DEBUG", $debug);

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
