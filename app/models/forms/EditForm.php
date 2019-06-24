<?php
namespace app\models\forms;
use \app\models\forms\Form;

class EditForm extends Form {

	protected $new_username;
	protected $new_email;
	protected $labels = [
		'new_username' => 'New username',
		'new_email' => 'New email'
	]

	public function __construct() {
		parent::__construct();
	}

	public function getValidationRules() {
		return [
			'new_username' => $this->createChain(new NotEmpty, [new PatternHandlers(self::$patternHandlers['username']), new StrLength(6, 12)]),
			'new_email' => $this->createChain(new NotEmpty, [new Email])
		];
	}
}