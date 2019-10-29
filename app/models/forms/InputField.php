<?php
namespace app\models\forms;

use app\helpers\ArrayHelper;
use app\helpers\validators\Validator;
use app\helpers\validators\ValidatorInterface;
use app\helpers\validators\ValidatorInterfaceBase;
use app\widgets\InputFieldWidget;

/**
 * Class InputFieldWidget
 * @package app\models\forms
 */
class InputField
{
    /** @var string|null $label */
    private $label;

    /** @var array|null */
    private $attributes;

    /** @var string|null $error */
    private $error;

    /** @var ValidatorInterface[]|null $validators */
    private $validators;

    /**
     * Indicates the need for validation
     *
     * @var bool $needValidate
     */
    private $needValidate = true;

    /** @var bool $state */
    private $state = true;

    /**
     * InputFieldWidget constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->label = ArrayHelper::getValue($config, 'label');
        $this->attributes = ArrayHelper::getValue($config, 'attributes');
        $this->validators = ArrayHelper::getValue($config, 'validators');
    }

    /**
     * @param string|null $value
     * @return InputField
     */
    public function setValue(string $value = null): InputField
    {
        $this->attributes['value'] = $value;

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
        return ArrayHelper::getValue($this->attributes, 'value');
    }

    /**
     * @return array|null
     */
    public function getValidators(): ?array
    {
        return $this->validators;
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

    /**
     * @return bool
     */
    public function getState(): bool
    {
        return $this->state;
    }

    /**
     * @param bool $state
     * @return InputField
     */
    public function setState(bool $state): InputField
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param bool $needValidate
     * @return InputField
     */
    public function setNeedValidate(bool $needValidate): InputField
    {
        $this->needValidate = $needValidate;

        return $this;
    }

    /**
     * @return bool
     */
    public function getNeedValidate(): bool
    {
        return $this->needValidate;
    }
}