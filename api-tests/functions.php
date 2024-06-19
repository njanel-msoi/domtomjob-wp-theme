<?php

function encrypt($key, $plaintext)
{
    return bin2hex(openssl_encrypt(
        $plaintext,
        API_CYPHER,
        $key,
        0,
        substr(hash('sha256', API_URL_HOME), 0, 16)
    ));
}
