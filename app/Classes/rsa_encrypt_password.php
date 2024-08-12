<?php

    # RSAEncryptPassword.php
    # only works with X509 PEM certs, any DER certs must first be converted

    $cert_path_data = getopt(null, ["certpath:"]);
    $password_data = getopt(null, ["password:"]);

    $cert_path = $cert_path_data['certpath'];
    $password = $password_data['password'];

    if (!file_exists($cert_path))
        echo("<p>Certificate does not exist in <em>" . $cert_path . "</em>");
        
        
    $file_size = filesize($cert_path);
    $cert_path_handle = fopen($cert_path, "r");
    $cert_data = fread($cert_path_handle, $file_size);
    fclose($cert_path_handle);
    $cert_data = openssl_x509_read($cert_data);
    $public_key = openssl_get_publickey($cert_data);

    openssl_public_encrypt($password, $encrypted_text, $public_key);

    echo base64_encode($encrypted_text);
    


