<?php
namespace app\helpers\handlers;

use app\helpers\ArrayHelper;

class InputErrorHandler {
    //private $input;
    private $label;
    private $min;
    private $max;
    private $messages;

    public function __construct($input) {
        //$this->input = $input;
        $this->label = $input->getLabel();
        $this->min = $input->getMinLength();
        $this->max = $input->getMaxLength();
//        $this->messages = [
//            'ValidatorNotEmpty' => "{$this->input->getLabel()} is required field.",
//            'ValidatorStrLength' => "{$this->input->getLabel()} must be between {$this->input->getMinLength()} and {$this->input->getMaxLength()} characters.",
//            'ValidatorNoRecordExists' => "{$this->input->getLabel()} already exists."
//        ];
        $this->messages = [
            'ValidatorNotEmpty' => "$this->label is required field.",
            'ValidatorStrLength' => "$this->label must be between $this->min and $this->max characters.",
            'ValidatorNoRecordExists' => "$this->label already exists."
        ];
    }

//    public function setInput($input) {
//        $this->input = $input;
//        return $this;
//    }

//    public function ValidatorNotEmpty() {
//        return "{$this->input->getLabel()} is required field.";
//    }
//
//     public function ValidatorStrLength() {
//        return "{$this->input->getLabel()} must be between {$this->input->getMinLength()} and {$this->input->getMaxLength()} characters.";
//     }
//
//     public function ValidatorNoRecordExists() {
//        return "{$this->input->getLabel()} already exists.";
//     }
//
//     public function ValidatorPatternHandlers($pattern) {
//        $messages = require PATH_MODELS_FORMS_CONFIG . 'error_messages.php';
//        return $messages[$pattern];
//     }

    public function getErrorMessage($validator) {
        //echo $validator;
        //$messages = require PATH_MODELS_FORMS_CONFIG . 'error_messages.php';
        return ArrayHelper::getValue($this->messages, $validator);
    }

    public function addErrorMessages($messages) {
        $this->messages = array_merge($this->messages, $messages);
        //var_dump($this->messages);
        return $this;
    }
}