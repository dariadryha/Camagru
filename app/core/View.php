<?php
namespace app\core;

class View
{
	function run($content, $model, $parameters = [])
	{
	    $content = PATH_VIEWS . "{$content}.php";

	    extract($parameters);

	    require_once PATH_VIEWS . 'layouts/template.php';
	}
}