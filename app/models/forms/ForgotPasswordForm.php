<?php
namespace app\models\forms;

use app\helpers\Token;
use app\models\db_models\ResetPasswordModel as RessPass;
use app\models\db_models\UserModel;
use app\traits\EmailSendingTrait;

/**
 * Class ForgotPasswordForm
 * @package app\models\forms
 */
class ForgotPasswordForm extends Form
{
    use EmailSendingTrait { generateLink as private; }
    /**
     * ForgotPasswordForm constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct(
            [
                'username' => new InputField(
                    [
                        'label' => 'Username',
                        'attributes' => [
                            'name' => 'username',
                        ],
                        'validators' => [
                            'notEmpty',
                            'recordExists',
                        ]
                    ]
                )
            ]
        );
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function resetPassword(): bool
    {
        $token = Token::generateToken(RessPass::TOKEN_LENGTH);

        /**
         * @var UserModel $user
         */
        $user = UserModel::read(
            [
                'username' => $this->getInputValue('username')
            ],
            [
                'id',
                'username',
                'email',
            ]
        );

        $ressPass = RessPass::load()
                                ->setUserId($user->getId())
                                ->setToken($token);

        return $ressPass->save() and $this->sendEmail($user, $token);
    }

    /**
     * @param UserModel $user
     * @param string $token
     * @return array
     */
    protected function sendEmail(UserModel $user, string $token): array
    {

        return [
            'subject' => 'Reset Password',
            'body' => 'forgot-password',
            'user' => $this->user,
            'additionalParameters' => [
                'link' => $this->generateLink(
                    [
                        'reset-password',
                        'reset-password',
                        $user->getId(),
                        $token
                    ]
                )
            ]
        ];
    }
}