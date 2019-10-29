<?php
namespace app\controllers;
use app\components\FlashMessage;
use \app\core\Controller;
use app\helpers\ArrayHelper;
use app\helpers\validators\ValidatorForm;
use app\helpers\validators\ValidatorTest;
use app\helpers\validators\ValidatorTimestampDiff;
use app\models\db_models\ChangeEmailModel;
use \app\models\forms\EditProfileForm;
use \app\models\UserModel;

class EditProfileController extends Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->model = new EditProfileForm();
	}

	public function actionIndex()
    {
		$this->view->run('forms/edit-profile', $this->model);
	}

	public function actionEditProfile()
    {
        $this->unsetIdenticalValues();

        $this->model->setInputValues($_POST);

        if (ValidatorForm::validate($this->model) and $this->model->edit()) {
            FlashMessage::success('Profile has been updated');
        } else {
            FlashMessage::error('Ooops. Something went wrong!', '/signin');
        }

        $this->actionIndex();
    }

    /**
     * @param int $id
     * @param string $hash
     * @throws \ReflectionException
     */
    public function actionConfirmEmail(int $id, string $hash)
    {
        /**
         * @var ChangeEmailModel $changePassword
         */
        $changeEmail = ChangeEmailModel::read(
            [
                'user_id' => $id
            ],
            ChangeEmailModel::COLUMNS
        );
//
//        if ($this->validateLink($changeEmail, $hash)) {
//
//        } else {
//
//        }
    }



    public function validateLink(ChangeEmailModel $changeEmail, string $hash): bool
    {
        if (!$changeEmail or !(new ValidatorTest('token', $changeEmail))->validate($hash)) {
            FlashMessage::error('Your confirm email link is not valid.');
        } else if (!(new ValidatorTimestampDiff($changeEmail))->validate($changeEmail->getCreationDate())) {
            FlashMessage::error('Email confirmation timed out.');
        } else {
            return true;
        }

        return false;
    }

    private function unsetIdenticalValues()
    {
        foreach ($this->model->getInputs() as $input) {
            if ($input->getValue() === ArrayHelper::getValue($_POST, $input->getName())) {
                $input->setNeedValidate(false);
            }
        }
    }
}
