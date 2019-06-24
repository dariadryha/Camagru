<?php
namespace app\models\forms;
use \app\models\forms\Form;

class ForgotForm extends Form {
	protected $username;
	protected $labels = [
		'username' => 'Username'
	];
}