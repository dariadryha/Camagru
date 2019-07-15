<?php
namespace app\helpers;
/**
 * Class RequestMethods
 * @package app\helpers
 */
class RequestMethods
{
	private function __construct() {}

    /**
     * @param string $name
     * @return string|null
     */
	public static function post(string $name): ?string
    {
        return ArrayHelper::getValue($_POST, $name);
	}
}
