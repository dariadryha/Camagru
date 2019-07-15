<?php
namespace app\models\forms;

use app\helpers\ArrayHelper;

/**
 * Class Form
 * @package app\models\forms
 */
class Form
{
    //TODO php doc for constant +
    const USERNAME_MIN_LENGTH = 6;
    const USERNAME_MAX_LENGTH = 12;

    const PASSWORD_MIN_LENGTH = 6;
    const PASSWORD_MAX_LENGTH = 12;

    /** @var string|null $action */
    private $action;

    /** @var string $method */
    private $method;

    /** @var InputField[]|null $inputs */
    protected $inputs;

    /** @var bool $state */
    private $state = true;

    /** @var array $inputPatterns */
    private static $inputPatterns;

    /** @var string $type */
    private $type;

    private $value;

    /**
     * Form constructor.
     * @param array $config
     */
    protected function __construct(array $config)
    {
        //TODO Form model need inheritance +
        $this->action = ArrayHelper::getValue($config, 'action');
        $this->method = ArrayHelper::getValue($config, 'method') ?? 'post';
        $this->inputs = ArrayHelper::getValue($config, 'inputs');
        $this->type = ArrayHelper::getValue($config, 'type') ?? 'submit';
        $this->value = ArrayHelper::getValue($config, 'value') ?? 'Submit';
    }

    /**
     * @return InputField[]|null
     */
    public function getInputs(): ?array
    {
        return $this->inputs;
    }

    /**
     * @return string|null
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @param array $values
     * @return Form
     */
    public function setInputValues(array $values): Form
    {
        foreach ($this->inputs as $column => $input) {
            $name = $input->getName();
            $value = ArrayHelper::getValue($values, $name);
            $input->setValue($value)
                ->setColumn($column);
        }
        //echo $this->inputs['username']->getColumn();
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $name
     * @return array|null
     */
    protected function getInputPatterns(string $name): ?array
    {
        self::$inputPatterns = self::$inputPatterns ?? require_once PATH_MODELS_FORMS_CONFIG . 'handlers.php';
        return ArrayHelper::getValue(self::$inputPatterns, $name);
    }

//    /**
//     * @param string $name
//     * @return array|null
//     */
//    protected static function getPatternInputErrors(string $name): ?array
//    {
//        $errors = require PATH_MODELS_FORMS_CONFIG . 'error_messages.php';
//        return ArrayHelper::getValue($errors, $name);
//    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->inputs as $input) {
            if ($input->validate())
                continue;
            $this->state = false;
        }
        return $this->state;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getInputValue(string $name): ?string
    {
        //$input = ArrayHelper::getValue($this->inputs, $name);
        return $this->inputs[$name]->getValue();
    }

    /**
     * @param string $name
     * @return callable
     */
    protected function getClosureInputValue(string $name): callable
    {
        return function () use ($name) {
            return $this->getInputValue($name);
        };
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
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
    public function getState(): bool
    {
        return $this->state;
    }
}

