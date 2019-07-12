<?php
namespace app\controllers;

use \app\core\Controller;
use app\helpers\HeaderHelper;
use \app\models\forms\SignupForm;
use \app\helpers\PostMethod;

/**
 * Class SignupController
 * @package app\controllers
 */
class SignupController extends Controller
{
    private $method;

	public function __construct()
    {
		parent::__construct();
		//TODO method
		$this->model = new SignupForm();
		$this->method = PostMethod::getData();
	}

	public function actionIndex()
    {
        //TODO change view
		$this->view->run('signup', ['signup' => $this->model]);
	}

	public function actionSignup()
    {
        //TODO do abstract
//		if (RequestMethods::post('submit'))
//		    $this->model->setInputValues($_POST);
        $this->model->setInputValues($this->method);
		//TODO need throw exceptions????
        if ($this->model->validate()) {
            $this->model->signup();
            HeaderHelper::redirect('/signin');
        }
        else {
            $this->actionIndex();
        }
	}
}
