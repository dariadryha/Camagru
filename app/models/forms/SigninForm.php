<?php
namespace app\models\forms;
use app\helpers\validators\ValidatorPasswordVerification as PasswordVerification;
use \app\helpers\validators\ValidatorRecordExists as RecordExists;
use \app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use app\models\UserModel;

class SigninForm extends Form {

	protected $username;
	protected $password;

	public function __construct($config) {
		parent::__construct();
		$this->labels = [
            'username' => 'Username',
            'password' => 'Password'
        ];
		$this->config = $config;
	}

	public function getValidationRules() {
		return [
			'username' => $this->createChain(new NotEmpty, [new RecordExists('Users', 'username')]),
			'password' => $this->createChain(new NotEmpty, [new PasswordVerification('Users', 'username', $this->username)])
		];
	}

    public function getFieldValues() {
        return [
            'username' => $this->username,
            'password' => $this->password
        ];
    }
}