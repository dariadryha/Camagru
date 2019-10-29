<?php
namespace app\controllers;

use app\components\FlashMessage;
use \app\core\Controller;
use app\helpers\validators\ValidatorTest;
use app\helpers\validators\ValidatorForm;
use app\helpers\validators\ValidatorTimestampDiff;
use app\models\db_models\AuthModel;
use app\models\db_models\UserModel;
use \app\models\forms\SignupForm;


/**
 * Class SignupController
 * @package app\controllers
 */
class SignupController extends Controller
{
    /**
     * SignupController constructor.
     */
	public function __construct()
    {
		parent::__construct();

		$this->model = new SignupForm();
	}

	public function actionIndex()
    {
        //TODO forms??
		$this->view->run('forms/signup', $this->model);
	}

    /**
     * @throws \Exception
     */
	public function actionSignup()
    {
        $this->model->setInputValues($_POST);

        if (ValidatorForm::validate($this->model) and $this->model->signup()) {
            FlashMessage::info('Thank you for registering to the Camagru website. 
            An account activation link has been sent to your mail.');
        } else {
            FlashMessage::error('Ooops. Something went wrong!');
        }

        $this->actionIndex();
	}

    /**
     * @param int $id
     * @param string $hash
     * @throws \ReflectionException
     */
	public function actionActivate(int $id, string $hash): void
    {
        /**
         * @var AuthModel $auth
         */
        $auth = AuthModel::read(
            [
                'user_id' => $id
            ],
            AuthModel::COLUMNS
        );

        /**
         * @var UserModel $user
         */
        $user = UserModel::load()
                            ->setId($id);

        if ($this->validateLink($auth, $user, $hash) and $this->activateUser($auth, $user)) {
            FlashMessage::success('Your account has been successfully activated. Sign in.', '/signin');
        } else {
            FlashMessage::error('Your account activation link is not valid.');
            $this->actionIndex();
        }
    }

    /**
     * @param AuthModel|bool $auth
     * @param UserModel $user
     * @param string $hash
     * @return bool
     * @throws \ReflectionException
     */
    public function validateLink($auth, UserModel $user, string $hash): bool
    {
        if (!$auth or !(new ValidatorTest('token', $auth))->validate($hash)) {
            FlashMessage::error('Your account activation link is not valid.');
        } else if (!(new ValidatorTimestampDiff($auth))->validate($auth->getCreationDate()) and $user->delete()) {
            FlashMessage::error('Account activation timed out.');
        } else {
            return true;
        }

        return false;
    }

    /**
     * @param AuthModel $auth
     * @param UserModel $user
     * @return bool
     */
    private function activateUser(AuthModel $auth, UserModel $user): bool
    {
        return $user->activate() and $auth->delete();
    }
}
