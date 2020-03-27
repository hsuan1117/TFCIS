<?php
/* From Internet*/
class Rsa {
    public $privateKey = '';
    public $publicKey = '';
    public function __construct(){
        $resource = openssl_pkey_new();
        openssl_pkey_export($resource, $this->privateKey);
        $detail = openssl_pkey_get_details($resource);
        $this->publicKey = $detail['key'];
    }
    public function publicEncrypt($data, $publicKey){
        openssl_public_encrypt($data, $encrypted, $publicKey);
        return $encrypted;
    }
    public function publicDecrypt($data, $publicKey){ 
        openssl_public_decrypt($data, $decrypted, $publicKey);
        return $decrypted;
    }
    public function privateEncrypt($data, $privateKey){
        openssl_private_encrypt($data, $encrypted, $privateKey);
        return $encrypted;
    }
    public function privateDecrypt($data, $privateKey){
        openssl_private_decrypt($data, $decrypted, $privateKey);
        return $decrypted;
    }
}
