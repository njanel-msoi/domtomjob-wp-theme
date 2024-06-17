<?php
if (!current_user_can('administrator')) exit("bye bye");

include 'companies.php';
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
}
