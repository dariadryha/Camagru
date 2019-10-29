<?php
namespace app\helpers\handlers;

use app\helpers\ArrayHelper;
use app\models\forms\InputField;

/**
 * Class InputErrorHandler
 * @package app\helpers\handlers
 */
class InputErrorHandler implements ErrorHandler
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
     * @param string $column
     * @param InputField $input
     */
    public function __construct(string $column, InputField $input)
    {
        $this->label = $input->getLabel();
        $this->min = $input->getMinLength();
        $this->max = $input->getMaxLength();
        $this->column = $column;
    }

    /**
     * @param string $validator
     * @return mixed
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
        $passwordCharacterSet = " * $this->label must include a minimum of three of the following mix of character types: letters, numbers, non-alphanumeric symbols.";
        $patternHandlersError = [
            'username' => [
                'characterSet' => "* $this->label must include the following character set: lowercase, numeric, non-alphanumeric symbols ._-",
                'firstCharacter' => "* $this->label must begin with a letter.",
                'lastCharacter' => "* $this->label must end with a letter or number."
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
            'notEmpty' => "* $this->label is required field.",
            'strLength' => "* $this->label must be between $this->min and $this->max characters.",
            'noRecordExists' => "* $this->label already exists.",
            'email' => "* $this->label is not valid.",
            'identical' => &$passwordsNotEqual,
            'patternHandlers' => ArrayHelper::getValue($patternHandlersError, $this->column),
            'recordExists' => "* $this->label doesn't exist.",
            'dbHashVerification' => &$passwordsNotEqual
        ];
    }
}