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

    /** @var Model $model */
	protected $model;

    /**
     * Controller constructor.
     */
	protected function __construct()
    {
		$this->view = new View();
	}
}