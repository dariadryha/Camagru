<?php
namespace app\models\forms;
use \app\models\forms\Form;

class ResetForm extends Form {
	protected $new_password;
	protected $confirm_new_password;

	public function __construct($config) {
		parent::__construct();
		$this->setLabels();
		$this->config = $config;
	}

	protected function setLabels() {
		$this->labels = [
			'new_password' => 'New password',
			'confirm_new_password' => 'Confirm new password'
		];
	}

	public function getValidationRules() {
		return [
			'new_password' => $this->createChain(
				new NotEmpty, [
				new PatternHandlers(self::$patterns['password']),
				new StrLength(6, 12)]),
			'confirm_new_password' => $this->createChain(
				new NotEmpty, [
				new Identical($this->new_password)])
		];
	}

	public function getFieldValues() {
		return [
			'new_password' => $this->new_password,
			'confirm_new_password' => $this->confirm_new_password
		];
	}
}
