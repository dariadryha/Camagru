<?php
namespace app\models\forms;
use \app\models\forms\Form;
use \app\helpers\validators\ValidatorPatternHandlers as PatternHandlers;
use \app\helpers\validators\ValidatorNoRecordExists as NoRecordExists;
use \app\helpers\validators\ValidatorStrLength as StrLength;
use \app\helpers\validators\ValidatorIdentical as Identical;
use \app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use \app\helpers\validators\ValidatorEmail as Email;
use \app\models\UserModel;

class SignupForm extends Form {
	protected $username;
	protected $email;
	protected $password;
	protected $confirm_password;

	public function __construct($config) {
		parent::__construct();
		$this->labels = [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirm_password' => 'Confirm password'
        ];
		$this->config = $config;
	}

	public function getValidationRules() {
		return [
			'username' => $this->createChain(
				new NotEmpty,
                [
                    new PatternHandlers(self::$patterns['username']),
                    new StrLength(
                        $this->getMinLength('username'),
                        $this->getMaxLength('username')
                    ),
                    new NoRecordExists('Users', 'username'),
                    new NotEmpty
                ]),
			'email' => $this->createChain(new NotEmpty, [new Email]),
			'password' => $this->createChain(
				new NotEmpty,
                [
                    new PatternHandlers(self::$patterns['password']),
                    new StrLength(
                        $this->getMinLength('password'),
                        $this->getMaxLength('password')
                    )
                ]),
			'confirm_password' => $this->createChain(new NotEmpty, [new Identical($this->password)])
		];
	}

	public function getFieldValues() {
		return [
			'username' => $this->username,
			'email' => $this->email,
			'password' => $this->password,
			'confirm_password' => $this->confirm_password
		];
	}

	public function signup() {
		$this->user = new UserModel();
		$this->user
            ->setUsername($this->username)
		    ->setEmail($this->email)
		    ->setPassword($this->password);
		return $this->user->save();
	}
}