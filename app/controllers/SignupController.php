<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\SignupForm;
use \app\helpers\RequestMethods;

class SignupController extends Controller {

	protected $model;

	public function __construct() {
		parent::__construct();
		$this->model = new SignupForm(require_once PATH_VIEWS_FORMS_CONFIG.'SignupForm.php');
	}

	public function actionIndex() {
		$this->view->run('signup', ['signup' => $this->model]);
	}

	public function actionRegister() {
		if (RequestMethods::post('submit'))
		{
			$this->model->setAttributes($_POST);
			if ($this->model->validate()) {
				$this->model->signup();
				$this->redirect('/signin');
			}
			else {
				$this->model->handleErrors();
				$this->actionIndex();
			}
		}
	}
	
}
