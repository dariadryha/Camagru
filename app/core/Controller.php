<?php
namespace app\core;
use app\core\View;
use app\core\Model;

class Controller
{
	protected $view;
	protected $model;

	protected function __construct() {
		$this->view = new View();
	}

	public function redirect($url) {
		header("Location:{$url}");
	}
}