<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\SigninForm;
use \app\helpers\RequestMethods;

class SigninController extends Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->model = new SigninForm();
	}

	public function actionIndex()
    {
		$this->view->run('signin', ['signin' => $this->model]);
	}

	public function actionSignin()
    {
	    if (RequestMethods::post('submit')) {
            $this->model->setInputValues($_POST);
            if ($this->model->validate()) {
                //$this->model->signin();
                //$this->redirect('/profile');
                echo "cool";
            } else {
                $this->actionIndex();
            }
        }
	}
}

