<?php
namespace app\core;

class View
{
	function run($content, $model)
	{
	    $content = PATH_VIEWS_FORMS . $content . '.php';
	    require_once PATH_VIEWS . 'layouts/template.php';
	}
}