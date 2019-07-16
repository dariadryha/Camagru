<?php
namespace app\controllers;

use \app\core\Controller;
use app\helpers\HeaderHelper;
use \app\models\forms\SignupForm;
use \app\helpers\RequestMethods;

/**
 * Class SignupController
 * @package app\controllers
 */
class SignupController extends Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->model = new SignupForm();
	}

	public function actionIndex()
    {
        //TODO change view
		$this->view->run('signup', $this->model);
	}

	public function actionSignup()
    {
        //var_dump($_POST);
        //TODO do abstract
//		if (RequestMethods::post('submit')) {
            $this->model->setInputValues($_POST);
            //TODO need throw exceptions????
            if ($this->model->validate() and $this->model->signup()) {
                HeaderHelper::redirect('/signin');
            } else {
                $this->actionIndex();
            }
//        }
	}
}
