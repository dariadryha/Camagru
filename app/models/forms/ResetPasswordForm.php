<?php
namespace app\models\forms;

use app\models\db_models\ResetPasswordModel as RessPass;
use app\models\db_models\UserModel;
use app\helpers\Email;

/**
 * Class ResetPasswordForm
 * @package app\models\forms
 */
class ResetPasswordForm extends Form
{
	public function __construct()
    {
		parent::__construct([
            'password' => new InputField(
                [
                    'label' => 'New password',
                    'attributes' => [
                        'name' => 'new_password',
                        'minlength' => self::INPUT_LENGTH['password']['minlength'],
                        'maxlength' => self::INPUT_LENGTH['password']['maxlength'],
                    ],
                    'validators' => [
                        'notEmpty',
                        'patternHandlers',
                        'strLength',
                    ]
                ]
            ),
            'confirm_password' => new InputField(
                [
                    'label' => 'Confirm new password',
                    'attributes' => [
                        'name' => 'confirm_new_password',
                    ],
                    'validators' => [
                        'notEmpty',
                        'identical',
                    ]
                ]
            )
        ]);
	}

    /**
     * @param int $id
     * @return bool
     * @throws \ReflectionException
     */
    public function changePassword(int $id): bool
    {
        /**
         * @var UserModel $user
         */
        $user = UserModel::read(
            [
                'id' => $id
            ],
            [
                'username',
                'email'
            ]
        );

        $user->setPassword($this->getInputValue('password'));

        $ressPass = RessPass::load()->setUserId($id);

        return $user->updatePassword()
                and $ressPass->delete()
                and $this->sendEmail($user);
    }

    /**
     * @param UserModel $user
     * @return array
     */
    public function passwordChangingMessage(UserModel $user): array
    {
        return [
            'subject' => 'Your Password Has Been Changed',
            'body' => 'reset-password',
            'user' => $user
        ];
    }
}
