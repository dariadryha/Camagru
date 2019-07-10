<?php
namespace app\models\forms;

use app\helpers\handlers\InputErrorHandler;
use app\helpers\validators\ValidatorChain;

class InputField {
    private $label;
    private $value;
    private $attributes;
    private $error;
    private $validators;

    public function __construct($config) {
        $this->label = $config['label'];
        $this->attributes = $config['attributes'];
        $this->validators = $config['validators'];
        $this->validators = ValidatorChain::createChain($this->validators[0], array_slice($this->validators, 1));
        $errorHandler = (new InputErrorHandler($this))->addErrorMessages($config['errorHandler']);
        $this->validators->setErrorHandler($errorHandler);
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getValue() {
        return $this->value;
    }

    public function validate() {
        if ($this->validators->validate($this->value)) {
            return true;
        }
        $this->setError($this->validators->getError());
        return false;
    }

    public function setError($error) {
        $this->error = $error;
        return $this;
    }

    public function getError() {
        return $this->error;
    }

    public function getMinLength() {
        return $this->attributes['minlength'];
    }

    public function getMaxLength() {
        return $this->attributes['maxlength'];
    }
}