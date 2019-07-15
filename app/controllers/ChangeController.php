<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\ChangeForm;
use \app\helpers\RequestMethods;
use \app\models\UserModel;
use \app\models\forms\ChangePasswordTest;
use \app\models\forms\ResetForm;
use \app\helpers\builders\FormBuilder;

class ChangeController extends Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->model['change'] = new ChangeForm();
		$this->model['reset'] = new ResetForm();
	}

	public function actionIndex()
    {
		$this->view->run('change_password', $this->model);
	}

	public function actionChange()
    {
	    if (RequestMethods::post('submit')) {
	        $this->model['change']->setInputValues($_POST);
            $this->model['reset']->setInputValues($_POST);
            $this->model['change']->validate();
            $this->model['reset']->validate();
            if ($this->model['reset']->getState() and $this->model['change']->getState())
            {
                echo "true";
            }
            else {
                echo "false";
                $this->actionIndex();
            }
        }
    }
}
