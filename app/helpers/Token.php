<?php
namespace app\helpers;

class Token
{
    /**
     * @param int $length
     * @return string
     * @throws \Exception
     */
    public static function generateToken(int $length): string
    {
        return bin2hex(random_bytes($length));
    }
}