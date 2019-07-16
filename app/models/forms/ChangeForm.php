<?php
namespace app\models\forms;

use app\helpers\validators\ValidatorBase;

/**
 * Class ChangeForm
 * @package app\models\forms
 */
class ChangeForm extends Form {
    public function __construct()
    {
        parent::__construct([
            'action' => '/password/change/change',
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
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'passwordVerification',
                            [
                                'Users',
                                [
                                    //TODO change value
                                    'column' => 'username',
                                    'value' => 'ddryha'
                                ]
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