<?php
namespace app\models\forms;

use app\helpers\validators\ValidatorInterfaceBase;

/**
 * Class ChangePasswordForm
 * @package app\models\forms
 */
class ChangePasswordForm extends Form
{
    public function __construct()
    {
        parent::__construct(
            [
                'password' => new InputField(
                    [
                        'label' => 'Old password',
                        'attributes' => [
                            'name' => 'old_password',
                        ],
                        'validators' => [
                            'notEmpty',
                            'dbHashVerification',
                        ]
                    ]
                )
        ]);
    }
}