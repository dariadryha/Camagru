<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\SignupForm;
use \app\helpers\RequestMethods;

class SignupController extends Controller {

	protected $model;

	public function __construct() {
		parent::__construct();
		$this->model = new SignupForm();
	}

	public function actionIndex() {
		$this->view->run('signup', ['signup' => $this->model]);
	}

	public function actionSignup() {
		if (RequestMethods::post('submit'))
		{
			$this->model->setInputValues($_POST);
			if ($this->model->validate()) {
				$this->model->signup();
				echo 'true';
				//$this->redirect('/signin');
			}
			else {
			    echo "false";
				$this->actionIndex();
			}
		}
	}
	
}
