<?php
namespace app\core;

class View
{
	function run($content, $models)
	{
	    require_once PATH_VIEWS_FORMS . $content . '.php';
	}
}