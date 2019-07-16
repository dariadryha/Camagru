<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\EditForm;
use \app\helpers\RequestMethods;
use \app\models\UserModel;

class EditController extends Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->model = new EditForm();
	}

	public function actionIndex()
    {
		$this->view->run('', $this->model);
	}
}
