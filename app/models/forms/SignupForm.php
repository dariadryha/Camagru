<?php
namespace app\models\forms;

use app\models\UserModel;
use app\helpers\validators\ValidatorEmail as Email;
use \app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use app\helpers\validators\ValidatorIdentical as Identical;
use \app\helpers\validators\ValidatorStrLength as StrLength;
use \app\helpers\validators\ValidatorPatternHandlers as PatternHandlers;
use \app\helpers\validators\ValidatorNoRecordExists as NoRecordExists;

/**
 * Class SignupForm
 * @package app\models\forms
 */
class SignupForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'action' => '/signup/signup',
            'inputs' => [
                'username' => new InputField([
                    'label' => 'Username',
                    'attributes' => [
                        'name' => 'username',
                        'type' => 'text',
                        'minlength' => self::USERNAME_MIN_LENGTH,
                        'maxlength' => self::USERNAME_MAX_LENGTH,
                        'id' => 'username'
                    ],
                    'validators' => [
                        new NotEmpty,
                        new PatternHandlers(
                            $this->getInputPatterns('username')
                        ),
                        new StrLength(
                            self::USERNAME_MIN_LENGTH,
                            self::USERNAME_MAX_LENGTH
                        ),
                        new NoRecordExists(
                            'Users',
                            'username'
                        )
                    ]
                ]),
                'email' => new InputField([
                    'label' => 'Email',
                    'attributes' => [
                        'name' => 'email',
                        'type' => 'email',
                        'id' => 'email'
                    ],
                    'validators' => [
                        new NotEmpty,
                        new Email
                    ]
                ]),
                'password' => new InputField([
                    'label' => 'Password',
                    'attributes' => [
                        'name' => 'password',
                        'type' => 'password',
                        'id' => 'password',
                        'minlength' => self::PASSWORD_MIN_LENGTH,
                        'maxlength' => self::PASSWORD_MAX_LENGTH,
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        new NotEmpty,
                        new PatternHandlers(
                            $this->getInputPatterns('password')
                        ),
                        new StrLength(
                            self::PASSWORD_MIN_LENGTH,
                            self::PASSWORD_MAX_LENGTH
                        )
                    ]
                ]),
                'confirm_password' => new InputField([
                    'label' => 'Confirm password',
                    'attributes' => [
                        'name' => 'confirm_password',
                        'type' => 'password',
                        'id' => 'confirm_password',
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        new NotEmpty,
                        new Identical(
                            $this->getClosureInputValue('password')
                        )
                    ]
                ])
            ],
            'type' => 'submit',
            'value' => "'Sign up'"
        ]);
    }

    /**
     * @return bool
     */
    public function signup(): bool
    {
        $user = new UserModel();

        $user
            ->setUsername($this->getInputValue('username'))
            ->setEmail($this->getInputValue('email'))
            ->setPassword($this->getInputValue('password'));
        return $user->save();
    }
}