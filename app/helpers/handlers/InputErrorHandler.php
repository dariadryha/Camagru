<?php
namespace app\helpers\handlers;

use app\helpers\ArrayHelper;
use app\models\forms\InputField;

/**
 * Class InputErrorHandler
 * @package app\helpers\handlers
 */
class InputErrorHandler
{
    /** @var string|null $label */
    private $label;

    /** @var int|null $min */
    private $min;

    /** @var int|null $max */
    private $max;

    /** @var string $column */
    private $column;

    /** @var array $errorMessages */
    private $errorMessages;

    /**
     * InputErrorHandler constructor.
     * @param InputField $input
     */
    public function __construct(InputField $input)
    {
        $this->label = $input->getLabel();
        $this->min = $input->getMinLength();
        $this->max = $input->getMaxLength();
        $this->column = function () use ($input) {
            return $input->getColumn();
        };
    }

    /**
     * @param string $validator
     * @return mixed|null
     */
    public function getErrorMessage(string $validator)
    {
        $this->errorMessages = $this->initErrorMessages();
        return ArrayHelper::getValue($this->errorMessages, $validator);
    }

    /**
     * @return array
     */
    public function initErrorMessages(): array
    {
        $passwordCharacterSet = " * $this->label must include a minimum of three of the following mix of character types: letters, numbers, non-alphanumeric symbols, for example !@#$%^&*()-_+={}[]|";
        $patternHandlersError = [
            'username' => [
                'characterSet' => "* $this->label must include the following character set: lowercase, numeric, non-alphanumeric symbols ._-",
                'firstCharacter' => "* $this->label must begin with a letter.",
                'lastCharacter' => "* $this->label must end with a letter or number."
            ],
            'email' => [
                'characterSet' => "* $this->label must include the following character set: letters, numeric, non-alphanumeric symbols .@-_",
                'firstPart' => "* Please enter the part before @.",
                'lastPart' => "* Please enter the part following @.",
                'domainZone' => "* Please complete email input."
            ],
            'password' => [
                'characterSet' => &$passwordCharacterSet,
                'letters' => &$passwordCharacterSet,
                'digits' => &$passwordCharacterSet,
                'nonAlphanumeric' => &$passwordCharacterSet
            ]
        ];
        $passwordsNotEqual = "* The passwords are not equal.";
        return [
            'ValidatorNotEmpty' => "* $this->label is required field.",
            'ValidatorStrLength' => "* $this->label must be between $this->min and $this->max characters.",
            'ValidatorNoRecordExists' => "* $this->label already exists.",
            'ValidatorEmail' => "* $this->label is not valid.",
            'ValidatorIdentical' => &$passwordsNotEqual,
            'ValidatorPatternHandlers' => ArrayHelper::getValue($patternHandlersError, ($this->column)()),
            'ValidatorRecordExists' => "* $this->label doesn't exist.",
            'ValidatorPasswordVerification' => &$passwordsNotEqual
        ];
    }
}