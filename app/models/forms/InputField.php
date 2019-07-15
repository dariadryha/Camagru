<?php
namespace app\models\forms;

use app\helpers\ArrayHelper;
use app\helpers\handlers\InputErrorHandler;
use app\helpers\validators\ValidatorChain;

/**
 * Class InputField
 * @package app\models\forms
 */
class InputField
{
    /** @var string|null $label */
    private $label;

    /** @var string|null $value */
    private $value;

    /** @var array|null $attributes */
    private $attributes;

    /** @var string|null $error */
    private $error;

    /** @var InputErrorHandler $errorHandler */
    private $errorHandler;

    /** @var ValidatorChain $validators */
    private $validators;

    /** @var string|null $column */
    private $column;

    /**
     * InputField constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->label = ArrayHelper::getValue($config, 'label');
        $this->attributes = ArrayHelper::getValue($config, 'attributes');
        $this->validators = ArrayHelper::getValue($config, 'validators');
        //$this->validators = ValidatorChain::createValidators($this->validators);
        $this->validators = ValidatorChain::createChain($this->validators[0], array_slice($this->validators, 1));
        $this->errorHandler = new InputErrorHandler($this);
    }

    /**
     * @param string|null $value
     * @return InputField
     */
    public function setValue(string $value = null): InputField
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function validate() {
        $this->validators->setErrorHandler($this->errorHandler);
        if ($this->validators->validate($this->value)) {
            return true;
        }
        $this->setError($this->validators->getError());
        return false;
    }

    /**
     * @param string|null $error
     * @return InputField
     */
    public function setError(string $error = null): InputField
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return int|null
     */
    public function getMinLength(): ?int
    {
        return ArrayHelper::getValue($this->attributes, 'minlength');
    }

    /**
     * @return int|null
     */
    public function getMaxLength(): ?int
    {
        return ArrayHelper::getValue($this->attributes, 'maxlength');
    }

    /**
     * @param string $column
     * @return InputField
     */
    public function setColumn(string $column): InputField
    {
        $this->column = $column;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getColumn(): ?string
    {
        return $this->column;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return ArrayHelper::getValue($this->attributes, 'name');
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }
}