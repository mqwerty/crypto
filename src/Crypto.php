<?php

namespace Mqwerty;

class Crypto
{
    protected string $key;
    protected string $cipher;

    public function __construct(string $key, string $cipher = 'aes-256-cbc')
    {
        $this->key = $key;
        $this->cipher = $cipher;
    }

    /**
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function encrypt(string $data): string
    {
        static $iv;
        if (!$iv) {
            $iv = random_bytes(openssl_cipher_iv_length($this->cipher));
        }
        $encrypted = openssl_encrypt($data, $this->cipher, $this->key, 0, $iv);
        return $encrypted . ':' . base64_encode($iv);
    }

    /**
     * @param $encrypted
     * @return string
     */
    public function decrypt(string $encrypted): string
    {
        $parts = explode(':', $encrypted);
        return openssl_decrypt($parts[0], $this->cipher, $this->key, 0, base64_decode($parts[1]));
    }
}
