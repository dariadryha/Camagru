<?php
namespace app\models\forms;

use app\models\db_models\UserModel;

/**
 * Class SigninForm
 * @package app\models\forms
 */
class SigninForm extends Form
{
    /**
     * SigninForm constructor.
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
                        ],
                        'validators' => [
                            'notEmpty',
                            'recordExists',
                        ]
                    ]
                ),
                'password' => new InputField(
                    [
                        'label' => 'Password',
                        'attributes' => [
                            'name' => 'password',
                        ],
                        'validators' => [
                            'notEmpty',
                            'dbHashVerification'
                        ]
                    ]
                )
            ]
        );
	}

    /**
     * @return bool
     */
	public function signin(): bool
    {
        $this->user = UserModel::read(
            [
                'username' => $this->getInputValue('username'),
            ],
            [
                'activated'
            ]
        );

        if ($this->user->getActivated()) {
            $_SESSION['username'] = $this->getInputValue('username');
        }

        return $this->user->getActivated();
    }
}