<?php

/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

namespace Unit;

use Mqwerty\Crypto;
use PHPUnit\Framework\TestCase;

final class CryptoTest extends TestCase
{
    public function testBase(): void
    {
        $data = 'SuperSecret';
        $key = bin2hex(random_bytes(16));
        $crypto = new Crypto($key);
        $result = $crypto->encrypt($data);
        self::assertSame($data, $crypto->decrypt($result));
    }
}
