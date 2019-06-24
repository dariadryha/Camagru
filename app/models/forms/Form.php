<?php
namespace app\models\forms;

abstract class Form {
	protected static $patterns;
	protected static $patternErrors;
	// protected $errorHandlers = [
	// 	'ValidatorNotEmpty' => 'handleEmptyField',
	// 	'ValidatorPatternHandlers' => 'handlePatternError',
	// 	'ValidatorStrLength' => 'handleInputLength',
	// 	'ValidatorEmail' => 'handleEmailError',
	// 	'ValidatorIdentical' => 'handlePasswordsMismatch',
	// 	'ValidatorNoRecordExists' => 'handleNotUniqueValue'
	// ];
	protected $config;
	protected $labels;
	protected $errors = [];
	private $user;

	protected function __construct() {
		if (!isset(self::$patterns))
			self::$patterns = require_once PATH_MODELS_FORMS_CONFIG.'handlers.php';
		if (!isset(self::$patternErrors))
			self::$patternErrors = require_once PATH_MODELS_FORMS_CONFIG.'error_messages.php';
	} 

	public function setAttributes($attributes) {
		foreach ($attributes as $attribute => $value) {
			$this->{$attribute} = $value;
		}
	}
	
	public function createChain($head, $links) {
		$temp = $head;

		foreach ($links as $link) {
			$temp = $temp->setNext($link);
		}
		return $head;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function getLabels() {
		return $this->labels;
	}

	public function getConfig() {
		return $this->config;
	}

	public function validate() {
		foreach ($this->getValidationRules() as $field => $chain) {
			if ($chain->validate($this->{$field}) === false) {
				$this->errors[$field] = $chain->getError();
			}
		}
		return empty($this->errors);
	}

    public function getMinLength($field) {
        return $this->config['elements'][$field]['minlength'];
    }

    public function getMaxLength($field) {
        return $this->config['elements'][$field]['maxlength'];
    }

    public function handleErrors() {
    	foreach ($this->errors as $field => $error) {
    		$this->errors[$field] = call_user_func_array(array('ErrorHandlers
    			', 'handleNotEmpty', array_merge([$field], $error['parameters']));
    	}
		// foreach ($this->errors as $field => $error) {
		// $this->errors[$field] = call_user_func_array(array($this, $this->errorHandlers[$error['validator']]), array_merge([$field], $error['parameters']));
		// }
	}

	abstract protected function getValidationRules();
	abstract protected function getFieldValues();
}

