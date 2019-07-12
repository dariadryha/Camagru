<?php
namespace app\core;
/**
 * Class Controller
 * @package app\core
 */
class Controller
{
    /** @var View $view */
	protected $view;

    //TODO model type;
	protected $model;

	protected function __construct()
    {
		$this->view = new View();
	}
}