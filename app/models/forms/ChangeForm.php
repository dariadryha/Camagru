<?php
namespace app\models\forms;
use \app\models\forms\Form;

class ChangeForm extends Form {

	protected $old_password;
	protected $new_password;
	protected $confirm_new_password;
	protected $labels = [
		'old_password' => 'Old password',
		'new_password' => 'New password',
		'confirm_new_password' => 'Confirm new password'
	];

	public function __construct() {
		parent::__construct();
	}

	public function getValidationRules() {
		return [
			'old_password' => $this->createChain(new NotEmpty, ),
			'new_password' => $this->createChain(new NotEmpty, [new PatternHandlers(self::$patternHandlers['password']), new StrLength(6, 12)]),
			'confirm_new_password' => $this->createChain(new NotEmpty, [new Identical($this->new_password)])
		];
	}
}