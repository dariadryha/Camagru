<?php
namespace app\models\forms;

use app\helpers\Token;
use app\models\db_models\ChangeEmailModel;
use app\models\db_models\UserModel;
use app\traits\EmailSendingTrait;

/**
 * Class EditProfileForm
 * @package app\models\forms
 */
class EditProfileForm extends Form
{
    use EmailSendingTrait { generateLink as private; }

    /**
     * EditProfileForm constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct(
            [
                'username' => new InputField(
                    [
                        'label' => 'New username',
                        'attributes' => [
                            'name' => 'new_username',
                            'minlength' => self::INPUT_LENGTH['username']['minlength'],
                            'maxlength' => self::INPUT_LENGTH['username']['maxlength'],
                            'value' => $_SESSION['username'],
                        ],
                        'validators' => [
                            'notEmpty',
                            'patternHandlers',
                            'strLength',
                            'noRecordExists',
                        ]
                    ]
                ),
                'email' => new InputField(
                    [
                        'label' => 'New email',
                        'attributes' => [
                            'name' => 'new_email',
                            'value' => UserModel::read(['username' => $_SESSION['username']], ['email'])->getEmail()
                        ],
                        'validators' => [
                            'notEmpty',
                            'email'
                        ]
                    ]
                )
            ]
        );
    }

    public function edit(): bool
    {
        /**
         * @var UserModel $user
         */
        $user = UserModel::read(
            [
                'username' => $_SESSION['username']
            ],
            [
                'id',
                'username',
                'email'
            ]
        );

        return $this->updateUsername($user) and $this->updateEmail($user);
    }

    /**
     * @param UserModel $user
     * @return bool
     */
    private function updateUsername(UserModel $user): bool
    {
        if (!$this->getInput('username')->getNeedValidate()) {
            return true;
        }

        $oldUsername = $user->getUsername();

        $user->setUsername($this->getInputValue('username'));


        $_SESSION['username'] = $user->getUsername();

        return $user->updateUsername();
        //return $user->updateUsername() and $this->sendEmail($this->updateUsernameMessage($user, $oldUsername));
    }

    private function updateEmail(UserModel $user): bool
    {
        if (!$this->getInput('email')->getNeedValidate()) {
            return true;
        }

        $this->sendEmail($user, $this->getInputValue('email'));

        $user->setEmail($this->getInputValue('email'));

        $token = Token::generateToken(ChangeEmailModel::TOKEN_LENGTH);
        $changeEmail =  ChangeEmailModel::load()
                                            ->setUserId($user->getId())
                                            ->setToken($token);

        return $user->updateEmail() and $changeEmail->save();

        //return $user->updateEmailMessage() and $changeEmail->save() and $this->confirmEmailMessage($user, $token);
    }

    /**
     * @param UserModel $user
     * @param string $oldUsername
     * @return array
     */
    private function updateUsernameMessage(UserModel $user, string $oldUsername): array
    {
        return [
            'subject' => 'Update Username',
            'body' => 'update-username',
            'user' => $user,
            'additionalParameters' => [
                'oldUsername' => $oldUsername
            ]
        ];
    }

    /**
     * @param UserModel $user
     * @param string $newEmail
     * @return array
     */
    private function updateEmailMessage(UserModel $user, string $newEmail): array
    {
        return [
            'subject' => 'Update Email',
            'body' => 'update-email',
            'user' => $user,
            'additionalParameters' => [
                'newEmail' => $newEmail
            ]
        ];
    }

    /**
     * @param UserModel $user
     * @param string $token
     * @return array
     */
    private function confirmEmailMessage(UserModel $user, string $token): array
    {

        return [
            'subject' => 'Confirm Email',
            'body' => 'confirm-email',
            'user' => $user,
            'additionalParameters' => [
                'link' =>  $this->generateLink(
                    [
                        'edit-profile',
                        'confirm-email',
                        $user->getId(),
                        $token
                    ]
                )
            ]
        ];
    }
}