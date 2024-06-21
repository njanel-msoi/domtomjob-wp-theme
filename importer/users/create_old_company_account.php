<?php
if (!current_user_can('administrator')) exit("bye bye");

$companies = include dirname(__FILE__) . '/old_companies.php';

foreach ($companies as $company) {
    $login = $company[0];
    $pass = $company[1];
    $email = $company[2];

    wp_insert_user([
        "user_login" => $email,
        "user_email" => $email,
        "user_pass" => $pass,
        "user_nicename" => $login,
        "role" => "employer"
    ]);
    echo "user <b>$email</b> created";
}
