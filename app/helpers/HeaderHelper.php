<?php
namespace app\helpers;
/**
 * Class HeaderHelper
 * @package app\helpers
 */
class HeaderHelper
{
    /**
     * @param string $url
     */
    public static function redirect(string $url)
    {
        //TODO uri, urn or url, Router also;
        header("Location:{$url}");
    }
}