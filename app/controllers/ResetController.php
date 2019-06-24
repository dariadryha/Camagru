<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\ResetForm;
use \app\helpers\RequestMethods;
use \app\models\UserModel;

class ResetController extends Controller {
	protected $form;

	public function __construct() {
		parent::__construct();
		$this->form = new ResetForm(require_once PATH_VIEWS_FORMS_CONFIG.'ResetForm.php');
	}

	public function actionIndex() {
		$this->view->run('form', 'reset_password', $this->form);
	}
}
