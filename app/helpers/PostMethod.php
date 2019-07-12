<?php
namespace app\helpers;
/**
 * Class PostMethod
 * @package app\helpers
 */
class PostMethod implements RequestMethods
{
    public static function getData() {
        return $_POST;
    }
}