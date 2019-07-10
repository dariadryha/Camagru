<?php
namespace app\models\forms;

abstract class Form {
    private $action;
    private $method = 'post';
    protected $inputs;

    protected function __construct($config) {
        $this->action = $config['action'];
        $this->inputs = $config['inputs'];
    }

    public function getInputs() {
        return $this->inputs;
    }

    public function getAction() {
        return $this->action;
    }

    public function setInputValues($values) {
        foreach ($this->inputs as $name => $input) {
            $input->setValue($values[$name]);
        }
    }

    public function getMethod() {
        return $this->method;
    }

    protected static function getInputPatterns($field) {
        $patterns = require PATH_MODELS_FORMS_CONFIG . 'handlers.php';
        return $patterns[$field];
    }

    protected static function getPatternInputErrors($field) {
        $errors = require PATH_MODELS_FORMS_CONFIG . 'error_messages.php';
        return $errors[$field];
    }

    public function validate() {
        foreach ($this->inputs as $input) {
            $input->validate();
        }
    }

    public function getInputValue($field) {
        return $this->inputs[$field]->getValue();
    }
}

