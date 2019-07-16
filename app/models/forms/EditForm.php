<?php
namespace app\models\forms;

use app\helpers\validators\ValidatorBase;

/**
 * Class EditForm
 * @package app\models\forms
 */
class EditForm extends Form {
    public function __construct()
    {
        parent::__construct([
            'action' => '/edit/edit',
            'inputs' => [
                'username' => new InputField([
                    'label' => 'New username',
                    'attributes' => [
                        'name' => 'new_username',
                        'type' => 'text',
                        'minlength' => self::USERNAME_MIN_LENGTH,
                        'maxlength' => self::USERNAME_MAX_LENGTH,
                        'id' => 'new_username'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'patternHandlers',
                            [$this->getInputPatterns('username')]
                        ),
                        ValidatorBase::load(
                            'strLength',
                            [
                                self::USERNAME_MIN_LENGTH,
                                self::USERNAME_MAX_LENGTH
                            ]
                        ),
                        ValidatorBase::load(
                            'noRecordExists',
                            [
                                'Users',
                                'username'
                            ]
                        )
                    ]
                ]),
                'email' => new InputField([
                    'label' => 'New email',
                    'attributes' => [
                        'name' => 'new_email',
                        'type' => 'email',
                        'id' => 'new_email'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load('email')
                    ]
                ])
            ],
            'type' => 'submit',
            'value' => "'Edit profile'"
        ]);
    }
}