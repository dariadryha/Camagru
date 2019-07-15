<?php
namespace app\models\forms;
use app\helpers\validators\ValidatorIdentical as Identical;
use app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use app\helpers\validators\ValidatorPatternHandlers as PatternHandlers;
use app\helpers\validators\ValidatorStrLength as StrLength;

class ResetForm extends Form
{
	public function __construct()
    {
		parent::__construct([
            'action' => '/reset/reset',
            'inputs' => [
                'password' => new InputField([
                    'label' => 'New password',
                    'attributes' => [
                        'name' => 'new_password',
                        'type' => 'password',
                        'id' => 'new_password'
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
                        'name' => 'confirm_new_password',
                        'type' => 'password',
                        'id' => 'confirm_new_password',
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
            'value' => "'Reset password'"
        ]);
	}
}
