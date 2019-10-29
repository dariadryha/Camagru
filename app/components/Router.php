<?php
namespace app\components;

use \Exception;

/**
 * Class Router
 * @package app\components
 */
class Router
{
    /** @var string $controllerNamespace */
	private $controllerNamespace = "\app\controllers\\";

    /** @var null|Router $instance */
	private static $instance = null;

    /** @var array $routes */
	private $routes;

	private function __construct()
    {
		$this->routes = require_once PATH_CONFIG.'routes.php';
	}

    /**
     * @return Router
     */
	public static function getInstance(): Router
    {
		if (!isset(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}

    /**
     * @return string
     */
	public function getURI(): string
    {
        return trim($_SERVER['REQUEST_URI'], '/');
	}

    /**
     * @param string $uri
     * @return string|null
     */
	public function getSegments(string $uri): ?string
    {
		foreach ($this->routes as $pattern => $value) {
			if (preg_match("/$pattern/", $uri)) {
				return preg_replace("/$pattern/", $value, $uri);
			}
		}
		return null;
	}

    /**
     * @param string $segment
     * @return string
     */
	public function getControllerName(string $segment): string
    {
        if (empty($segment))
            return $this->routes['default_controller'];

        $segmentPieces = array_map('ucfirst', explode('-', $segment));

        return implode('', $segmentPieces);
    }

    public function getActionName(string $segment)
    {
        $segmentPieces = array_map('ucfirst', explode('-', $segment));

        return implode('', $segmentPieces);
    }

	public function run()
    {
		$uri = $this->getURI();
		$segments = $this->getSegments($uri);
		$segments = explode('/', $segments);

        $controllerName = $this->getControllerName($segments[0]);

		$action = $segments[1] ?? $this->routes['default_action'];
		$parameters = array_slice($segments, 2);
		$controllerName = $this->controllerNamespace . $controllerName . 'Controller';
		$action = 'action' . $this->getActionName($action);
           // 'action' . ucfirst($action);
//		echo $action;
//		exit();
		try {
			$controller = new $controllerName;
            //$controller = $controllerName;
			if(!is_callable(array($controller, $action)))
				echo "Error in router action\n";
			else
				call_user_func_array([$controller, $action], $parameters);

		} catch (Exception $e) {
			 echo $e->getMessage(), "\n";
		}
	}
}