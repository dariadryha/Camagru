<?php
namespace app\helpers;

class RequestMethods {
	private function __construct() {}

	public static function post($name) {
		if (isset($_POST[$name]))
			return $_POST[$name];
		return null;
	}
}