<?php
namespace app\models\forms;
use \app\models\forms\Form;
use \app\helpers\validators\ValidatorNotEmpty as NotEmpty;

class ChangePasswordTest extends Form {

	protected $old_password;

	public function __construct($config) {
		parent::__construct();
		$this->setLabels();
		$this->config = $config;
	}

	public function getValidationRules() {
		return [
			'old_password' => new NotEmpty
		];
	}

	protected function setLabels() {
		$this->labels = [
			'old_password' => 'Old password'
		];
	}

	public function getFieldValues() {
		return [
			'old_password' => $this->old_password
		];
	}
}