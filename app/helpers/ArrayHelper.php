<?php
namespace app\helpers;

/**
 * Class ArrayHelper
 * @package app\helpers
 */
class ArrayHelper
{
    /**
     * @param array $array
     * @param $key
     * @return mixed|null
     */
    public static function getValue(array $array, $key)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return null;
    }
}