<?php
spl_autoload_register(function ($className) {
	$className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
	$className = PATH_ROOT.$className.'.php';
	if (file_exists($className)) {
		require_once($className);
	}
	else {
		throw new Exception("Unable to load $className");
	}
});
