<?php
namespace app\controllers;
use app\components\FlashMessage;
use \app\core\Controller;
use app\helpers\HeaderHelper;
use app\helpers\validators\ValidatorForm;
use \app\models\forms\SigninForm;

/**
 * Class SigninController
 * @package app\controllers
 */
class SigninController extends Controller
{
    /**
     * SigninController constructor.
     * @throws \ReflectionException
     */
	public function __construct()
    {
		parent::__construct();

		$this->model = new SigninForm();
	}

	public function actionIndex()
    {
		$this->view->run('forms/signin', $this->model);
	}

	public function actionSignin()
    {
        $this->model->setInputValues($_POST);

        if (ValidatorForm::validate($this->model)) {
            if ($this->model->signin()) {
                HeaderHelper::redirect('/profile');
            } else {
                FlashMessage::error('Please, activate your account.', '/signup');
            }
        } else {
            FlashMessage::error('Ooops. Something went wrong!');
            $this->actionIndex();
        }
	}
}

