<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\ResetForm;
use \app\helpers\RequestMethods;
use \app\models\UserModel;

class ResetController extends Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->model = new ResetForm();
	}

	public function actionIndex()
    {
		$this->view->run('reset_password', ['reset' => $this->model]);
	}

	public function actionReset()
    {
        if (RequestMethods::post('submit')) {
            $this->model->setInputValues($_POST);
            if ($this->model->validate())
                echo "true";
            else {
                echo "false";
                $this->actionIndex();
            }
        }
    }
}