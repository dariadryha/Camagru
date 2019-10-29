<?php
namespace app\components;

use app\helpers\HeaderHelper;

class FlashMessage
{
    private static function message(string $type, string $message, string $url)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];

        if ($url)
            HeaderHelper::redirect($url);
    }

    public static function info(string $message, string $url = '')
    {
        self::message('info', $message, $url);
    }

    public static function success(string $message, string $url = '')
    {
        self::message('success', $message, $url);
    }

    public static function error(string $message, string $url = '')
    {
        self::message('danger', $message, $url);
    }

    public static function hasMessage()
    {
        return isset($_SESSION['flash']);
    }

    public static function reset()
    {
        unset($_SESSION['flash']);
    }

    public static function getMessage()
    {
        $result = $_SESSION['flash'];
        self::reset();

        return $result;
    }
}