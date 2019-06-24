<?php
namespace app\components;

class Router
{
	private $controllerNamespace = "\app\controllers\\";
	private static $instance = NULL;
	private $config;

	private function __construct() {
		$this->config = require_once PATH_CONFIG.'routes.php'; 
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function getURI() {
		return trim($_SERVER['REQUEST_URI'], '/');
	}

	public function applyHandlers($uri) {
		foreach ($this->config as $pattern => $value) {
			//echo "/$pattern/";
			//echo trim($_SERVER['REQUEST_URI'], '/');
			//echo $uri;
			if (preg_match("/$pattern/", $uri)) {
				return preg_replace("/$pattern/", $value, $uri);
			}
		}
		return $this->config['default_controller'];
	}

	public function run() {
		$action = 'index';

		$uri = $this->getURI();
		$routes = $this->applyHandlers($uri);
		$routes = explode('/', $routes);
		//var_dump($routes);
		if (!empty($routes[0]))
			$controllerName = ucfirst($routes[0]);
		if (!empty($routes[1]))
			$action = $routes[1];
		$routes = array_slice($routes, 2);
		$controllerName = $this->controllerNamespace.$controllerName.'Controller';
		$action = 'action' . ucfirst($action);
		try {
			$controller = new $controllerName;
			if(!is_callable(array($controller, $action)))
				echo "Error in router action\n";
			else
				call_user_func_array([$controller, $action], $routes);

		} catch (\Exception $e) {
			 echo $e->getMessage(), "\n";
		}
	}
}