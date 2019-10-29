<?php
namespace app\controllers;
use app\components\FlashMessage;
use \app\core\Controller;
use app\helpers\validators\ValidatorForm;
use \app\models\forms\ForgotPasswordForm;
use \app\models\UserModel;

/**
 * Class ForgotPasswordController
 * @package app\controllers
 */
class ForgotPasswordController extends Controller
{
    /**
     * ForgotPasswordController constructor.
     * @throws \ReflectionException
     */
	public function __construct()
    {
		parent::__construct();

		$this->model = new ForgotPasswordForm();
	}

	public function actionIndex()
    {
        $this->view->run('forms/forgot-password', $this->model);
	}

    /**
     * @throws \Exception
     */
	public function actionResetPassword()
    {
        $this->model->setInputValues($_POST);

        if (ValidatorForm::validate($this->model) and $this->model->resetPassword()) {
            FlashMessage::info('Thanks! Please check your email address for a link to reset your password.');
        } else {
            FlashMessage::error('Ooops. Something went wrong!');
        }

        $this->actionIndex();
    }
}
