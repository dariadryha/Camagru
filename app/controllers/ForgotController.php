<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\ForgotForm;
use \app\helpers\RequestMethods;
use \app\models\UserModel;

class ForgotController extends Controller {
	protected $form;

	public function __construct() {
		parent::__construct();
		$this->form = new ForgotForm();
	}

	public function actionIndex() {
		$this->view->run($this->form);
	}
}
