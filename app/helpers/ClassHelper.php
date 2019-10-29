<?php
namespace app\helpers;

/**
 * Class ClassHelper
 * @package app\helpers
 */
class ClassHelper
{
    /**
     * @param mixed $obj
     * @return string
     * @throws \ReflectionException
     */
    public static function getShortName($obj): string
    {
        return (new \ReflectionClass($obj))->getShortName();
    }

    /**
     * @param string $nameClass
     * @param array $parameters
     * @return mixed
     */
    public static function createInstance(string $nameClass, array $parameters = [])
    {
        //TODO mixed
        return new $nameClass(...$parameters);
    }

    public static function getControllerName($obj)
    {
        $name = self::getShortName($obj);
        $name = str_replace('Controller', '', $name);
        return $name;
    }
}