<?php
namespace app\models\forms;

use app\helpers\ArrayHelper;

/**
 * Class Form
 * @package app\models\forms
 */
class Form {
    /** @var string|null $action */
    private $action;

    /** @var string $method */
    private $method;

    /** @var InputField[]|null */
    protected $inputs;

    /** @var bool */
    private $state = true;

    /**
     * Form constructor.
     * @param array $config
     */
    protected function __construct(array $config)
    {
        //TODO Form model need inheritance
        $this->action = ArrayHelper::getValue($config, 'action');
        //TODO check get method property;
        //$this->method = ArrayHelper::getValue($config, 'method') ?? 'post';
        $this->method = $config['method'] ?? 'post';
        $this->inputs = ArrayHelper::getValue($config, 'inputs');
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
        foreach ($this->inputs as $name => $input) {
            $value = ArrayHelper::getValue($values, $name);
            $input->setValue($value);
        }
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
    protected static function getInputPatterns(string $name): ?array
    {
        $patterns = require PATH_MODELS_FORMS_CONFIG . 'handlers.php';
        return ArrayHelper::getValue($patterns, $name);
    }

    /**
     * @param string $name
     * @return array|null
     */
    protected static function getPatternInputErrors(string $name): ?array
    {
        $errors = require PATH_MODELS_FORMS_CONFIG . 'error_messages.php';
        return ArrayHelper::getValue($errors, $name);
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->inputs as $input) {
            if ($input->validate())
                continue ;
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
        return $this->inputs[$name]->getValue();
    }
}

