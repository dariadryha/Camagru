<?php
namespace app\controllers;

use app\components\FlashMessage;
use \app\core\Controller;
use \app\models\forms\ChangePasswordForm;
use \app\models\forms\ResetPasswordForm;
use app\helpers\validators\ValidatorForm;
use app\models\db_models\UserModel;

class ChangePasswordController extends Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->model['changePassword'] = new ChangePasswordForm();
		$this->model['resetPassword'] = new ResetPasswordForm();
	}

	public function actionIndex()
    {
		$this->view->run('forms/change-password', $this->model);
	}

    /**
     * @throws \ReflectionException
     */
	public function actionChangePassword()
    {
        /**
         * @var ChangePasswordForm $changePassword
         * @var ResetPasswordForm $resetPassword
         */
        extract($this->model);

        $changePassword->setInputValues($_POST);
        $resetPassword->setInputValues($_POST);

        if ($this->validate() and $resetPassword->changePassword(
                UserModel::read(['username' => $_SESSION['username']], ['id'])->getId())) {
            FlashMessage::success('Your password has been successfully changed.');
        }
        else {
            FlashMessage::error('Ooops. Something went wrong!');
        }

        $this->actionIndex();
    }

    /**
     * @return bool
     */
    private function validate(): bool
    {
        /**
         * @var ChangePasswordForm $changePassword
         * @var ResetPasswordForm $resetPassword
         */
        extract($this->model);

        ValidatorForm::validate($changePassword);
        ValidatorForm::validate($resetPassword);

        return $changePassword->getState() and $resetPassword->getState();
    }
}

