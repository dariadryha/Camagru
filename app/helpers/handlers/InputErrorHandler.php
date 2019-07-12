<?php
namespace app\helpers\handlers;

use app\helpers\ArrayHelper;

class InputErrorHandler {
    private $label;
    private $min;
    private $max;
    private $messages;

    public function __construct($input) {
        $this->label = $input->getLabel();
        $this->min = $input->getMinLength();
        $this->max = $input->getMaxLength();
        $this->messages = [
            'ValidatorNotEmpty' => "* $this->label is required field.",
            'ValidatorStrLength' => "* $this->label must be between $this->min and $this->max characters.",
            'ValidatorNoRecordExists' => "* $this->label already exists.",
            'ValidatorEmail' => "* $this->label is not valid.",
            'ValidatorIdentical' => "* The passwords are not equal."
        ];
    }

    public function getErrorMessage($validator) {
        return ArrayHelper::getValue($this->messages, $validator);
    }

    public function addErrorMessages($messages) {
        $this->messages = array_merge($this->messages, $messages);
        return $this;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     */
    public function setMessages(array $messages): void
    {
        $this->messages = $messages;
    }
}