<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\EditForm;
use \app\helpers\RequestMethods;
use \app\models\UserModel;

class EditController extends Controller {
	protected $form;

	public function __construct() {
		parent::__construct();
		$this->form = new EditForm();
	}

	public function actionIndex() {
		$this->view->run($this->form);
	}
}
