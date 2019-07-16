<?php
namespace app\models\forms;

use app\helpers\validators\ValidatorBase;

/**
 * Class ResetForm
 * @package app\models\forms
 */
class ResetForm extends Form
{
	public function __construct()
    {
		parent::__construct([
            'action' => '/password/reset/reset',
            'inputs' => [
                'password' => new InputField([
                    'label' => 'New password',
                    'attributes' => [
                        'name' => 'new_password',
                        'type' => 'password',
                        'id' => 'new_password'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'patternHandlers',
                            [$this->getInputPatterns('password')]
                        ),
                        ValidatorBase::load(
                            'strLength',
                            [
                                self::PASSWORD_MIN_LENGTH,
                                self::PASSWORD_MAX_LENGTH
                            ]
                        )
                    ]
                ]),
                'confirm_password' => new InputField([
                    'label' => 'Confirm new password',
                    'attributes' => [
                        'name' => 'confirm_new_password',
                        'type' => 'password',
                        'id' => 'confirm_new_password',
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'identical',
                            [$this->getClosureInputValue('password')]
                        )
                    ]
                ])
            ],
            'type' => 'submit',
            'value' => "'Reset password'"
        ]);
	}
}
