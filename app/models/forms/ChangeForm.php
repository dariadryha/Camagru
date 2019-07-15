<?php
namespace app\models\forms;
use app\helpers\validators\ValidatorIdentical as Identical;
use app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use app\helpers\validators\ValidatorPasswordVerification as PasswordVerification;
use app\helpers\validators\ValidatorPatternHandlers as PatternHandlers;
use app\helpers\validators\ValidatorStrLength as StrLength;

class ChangeForm extends Form {
    public function __construct()
    {
        parent::__construct([
            'action' => '/change/change',
            'inputs' => [
                'password' => new InputField([
                    'label' => 'Old password',
                    'attributes' => [
                        'name' => 'old_password',
                        'type' => 'password',
                        'id' => 'old_password',
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        new NotEmpty,
                        new PasswordVerification(
                            'Users',
                            [
                                'column' => 'username',
                                'value' => 'ddryha'
                            ]
                        )
                    ]
                ])
            ],
            'type' => 'submit',
            'value' => "'Change password'"
        ]);
    }
}