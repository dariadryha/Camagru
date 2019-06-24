<?php
namespace app\controllers;
use \app\core\Controller;
use \app\models\forms\ChangeForm;
use \app\helpers\RequestMethods;
use \app\models\UserModel;
use \app\models\forms\ChangePasswordTest;
use \app\models\forms\ResetForm;
use \app\helpers\builders\FormBuilder;

class ChangeController extends Controller {

	private $modelChange;
	private $modelReset;

	public function __construct() {
		parent::__construct();
		$this->modelChange = new ChangeForm(require_once PATH_VIEWS_FORMS_CONFIG.'ChangeForm.php');
		$this->modelReset = new ResetForm(require_once PATH_VIEWS_FORMS_CONFIG.'ResetForm.php');
	}

	public function actionIndex() {
		$this->view->run('change_password', [
		    'change' => $this->modelChange,
            'reset' => $this->modelReset
        ]);
	}

	public function actionChange() {
	    if (RequestMethods::post('submit')) {
	        $this->modelChange->setAttributes($_POST);
            $this->modelReset->setAttributes($_POST);
            if ($this->modelChange->validate() && $this->modelReset->validate()) {
                echo "true"
            }
            else {
                echo "false";
            }
        }

    }
}
