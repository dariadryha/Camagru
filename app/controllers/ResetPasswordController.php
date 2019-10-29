<?php
namespace app\controllers;
use app\components\FlashMessage;
use \app\core\Controller;
use app\helpers\HeaderHelper;
use app\helpers\validators\ValidatorForm;
use app\helpers\validators\ValidatorTest;
use app\helpers\validators\ValidatorTimestampDiff;
use app\models\db_models\ResetPasswordModel;
use \app\models\forms\ResetPasswordForm;

class ResetPasswordController extends Controller
{
    const ACTION = "/reset-password/change-password/";

	public function __construct()
    {
		parent::__construct();

		$this->model = new ResetPasswordForm();
	}

	public function actionIndex(int $id)
    {
        $this->model->setAction(self::ACTION . $id);

		$this->view->run('forms/reset-password', $this->model);
	}

    /**
     * @param int $id
     * @param string $hash
     * @throws \ReflectionException
     */
	public function actionResetPassword(int $id, string $hash)
    {
        /**
         * @var ResetPasswordModel $user
         */
        $ressPass = ResetPasswordModel::read(
            [
                'user_id' => $id
            ],
            ResetPasswordModel::COLUMNS
        );

        if ($this->validateLink($ressPass, $hash)) {
            $this->actionIndex($id);
        } else {
            HeaderHelper::redirect('/forgot-password');
        }
    }

    /**
     * @param ResetPasswordModel $ressPass
     * @param string $hash
     * @return bool
     * @throws \ReflectionException
     */
    public function validateLink(ResetPasswordModel $ressPass, string $hash)
    {
        if (!$ressPass or !((new ValidatorTest('token', $ressPass))->validate($hash))) {
            FlashMessage::error('Password reset link is invalid');
        } else if (!((new ValidatorTimestampDiff($ressPass))->validate($ressPass->getCreationDate())) and $ressPass->delete()) {
            FlashMessage::error('Password reset timed out. Try again.');
        } else {
            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @throws \ReflectionException
     */
	public function actionChangePassword(int $id)
    {
        $this->model->setInputValues($_POST);

        if (ValidatorForm::validate($this->model) and $this->model->changePassword($id)) {
            FlashMessage::success('Your password has been successfully changed.', '/signin');
        } else {
            FlashMessage::error('Ooops. Something went wrong!');
            $this->actionIndex($id);
        }
    }
}