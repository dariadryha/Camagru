<?php
namespace app\models\forms;

use app\models\db_models\AuthModel;
use app\helpers\Token;
use app\models\db_models\UserModel;
use app\traits\EmailSendingTrait;

/**
 * Class SignupForm
 * @package app\models\forms
 */
class SignupForm extends Form
{
    use EmailSendingTrait
    {
        generateLink as private;
        sendEmail as private;
    }

    /**
     * SignupForm constructor.
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
                            'minlength' => self::INPUT_LENGTH['username']['minlength'],
                            'maxlength' => self::INPUT_LENGTH['username']['maxlength'],
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
                        'label' => 'Email',
                        'attributes' => [
                            'name' => 'email',
                        ],
                        'validators' => [
                            'notEmpty',
                            'email',
                        ]
                    ]
                ),
                'password' => new InputField(
                    [
                        'label' => 'Password',
                        'attributes' => [
                            'name' => 'password',
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
                        'label' => 'Confirm password',
                        'attributes' => [
                            'name' => 'confirm_password',
                        ],
                        'validators' => [
                            'notEmpty',
                            'identical',
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
    public function signup(): bool
    {
        $token = Token::generateToken(AuthModel::TOKEN_LENGTH);

        $this->user = UserModel::load()
            ->setUsername($this->getInputValue('username'))
            ->setEmail($this->getInputValue('email'))
            ->setPassword($this->getInputValue('password'));

        $auth = AuthModel::load()->setToken($token);

        return $this->user->save()
                and $auth->save()
                and $this->sendEmail($this->activateAccountMessage($auth, $token));
    }

    /**
     * @param AuthModel $auth
     * @param string $token
     * @return array
     */
    protected function activateAccountMessage(AuthModel $auth, string $token): array
    {
        return [
            'subject' => 'Complete Sign Up',
            'body' => 'signup',
            'user' => $this->user,
            'additionalParameters' => [
                'link' => $this->generateLink(
                    [
                        'signup',
                        'activate',
                        $auth->getUserId(),
                        $token
                    ]
                )
            ]
        ];
    }
}
