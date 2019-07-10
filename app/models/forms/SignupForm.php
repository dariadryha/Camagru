<?php
namespace app\models\forms;

use app\helpers\handlers\InputErrorHandler;
use app\models\UserModel;
use app\helpers\validators\ValidatorEmail as Email;
use \app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use app\helpers\validators\ValidatorIdentical as Identical;
use \app\helpers\validators\ValidatorStrLength as StrLength;
use \app\helpers\validators\ValidatorPatternHandlers as PatternHandlers;
use \app\helpers\validators\ValidatorNoRecordExists as NoRecordExists;

class SignupForm extends Form
{
    const USERNAME_MIN_LENGTH = 6;
    const USERNAME_MAX_LENGTH = 12;

    const PASSWORD_MIN_LENGTH = 6;
    const PASSWORD_MAX_LENGTH = 12;

    public function __construct() {
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
                        new NotEmpty(),
                        new PatternHandlers(
                            self::getInputPatterns('username')
                        ),
                        new StrLength(
                            self::USERNAME_MIN_LENGTH,
                            self::USERNAME_MAX_LENGTH
                        ),
                        new NoRecordExists(
                            'Users',
                            'username'
                        )
                    ],
                    'errorHandler' => [
                        'ValidatorPatternHandlers' => self::getPatternInputErrors('username')
                    ]
                ])
//                'email' => new InputField([
//                    'attributes' => [
//                        'name' => 'email',
//                        'type' => 'email',
//                        'id' => 'email'
//                    ],
//                    'validators' => [
//                        new NotEmpty(),
//                        new Email
//                    ],
//                    'label' => 'Email'
//                ]),
//                'password' => ($password = new InputField([
//                    'attributes' => [
//                        'name' => 'password',
//                        'type' => 'password',
//                        'id' => 'password',
//                        'minlength' => self::PASSWORD_MIN_LENGTH,
//                        'maxlength' => self::PASSWORD_MAX_LENGTH,
//                        'autocomplete' => 'off'
//                    ],
//                    'validators' => [
//                        new NotEmpty(),
//                        new PatternHandlers(
//                            self::getFieldPatterns('password')
//                        ),
//                        new StrLength(
//                            self::PASSWORD_MIN_LENGTH,
//                            self::PASSWORD_MAX_LENGTH
//                        )
//                    ],
//                    'label' => 'Password'
//                ])),
//                'confirm_password' => new InputField([
//                    'attributes' => [
//                        'name' => 'confirm_password',
//                        'type' => 'password',
//                        'id' => 'confirm_password',
//                        'autocomplete' => 'off'
//                    ],
//                    'validators' => [
//                        new NotEmpty(),
//                        new Identical(function () use ($password) {
//                            return $password->getValue();
//                        })
//                    ],
//                    'label' => 'Confirm password'
//                ])
            ],
            'submit' => [
                'type' => 'submit',
                'value' => "'Sign up'"
            ]
        ]);
    }

    public function signup() {
        $user = new UserModel();

        $user
            ->setUsername($this->getInputValue('username'))
            ->setEmail($this->getInputValue('email'))
            ->setPassword($this->getInputValue('password'));
        return $user->save();
    }
}