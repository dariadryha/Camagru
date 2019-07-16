<?php
namespace app\models\forms;

use app\helpers\validators\ValidatorBase;

/**
 * Class ForgotForm
 * @package app\models\forms
 */
class ForgotForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'action' => '/password/forgot/forgot',
            'inputs' => [
                'username' => new InputField([
                    'label' => 'Username',
                    'attributes' => [
                        'name' => 'username',
                        'type' => 'text',
                        'id' => 'username'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load('recordExists',
                            [
                                'Users',
                                'username'
                            ]
                        )
                    ]
                ])
            ],
            'type' => 'submit',
            'value' => "'Reset password'"
        ]);
    }
}