<?php

function encrypt_old($key, $plaintext) {

    //$iv = 'fedcba9876543210';
    //$key = '0123456789abcdef';

    $iv = substr(hash('sha256', API_URL_HOME), 0, 16);
    
    $td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

    mcrypt_generic_init($td, $key, $iv);
    $encrypted = mcrypt_generic($td, $plaintext);

    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

    return bin2hex($encrypted);
    
    
    
}

function encrypt($key, $plaintext) {
    return bin2hex( openssl_encrypt(
        $plaintext,
        API_CYPHER,
        $key,
        0,
        substr(hash('sha256', API_URL_HOME), 0, 16)
    ) );
}
