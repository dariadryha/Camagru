<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\SigninForm;
use \app\helpers\RequestMethods;

class SigninController extends Controller {
	protected $model;

	public function __construct() {
		parent::__construct();
		$this->model = new SigninForm(require_once PATH_VIEWS_FORMS_CONFIG . 'SigninForm.php');
	}

	public function actionIndex() {
		$this->view->run('signin', ['signin' => $this->model]);
	}

	public function actionLogin() {
		if (RequestMethods::post('submit'))
		{
			$this->model->setAttributes($_POST);
			if ($this->model->validate()) {
			    //$this->model->signin();
                //$this->redirect('/profile');
                echo "cool";
            }
			else {
                $this->model->handleErrors();
                $this->actionIndex();
            }
		}
	}
}

