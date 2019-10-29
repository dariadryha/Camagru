<?php
namespace app\models\forms;

use app\helpers\ArrayHelper;
use app\traits\IdentifierTrait;
use app\helpers\ClassHelper;
use app\helpers\Email;
use app\models\db_models\UserModel;
use http\Client\Curl\User;

/**
 * Class Form
 * @package app\models\forms
 */
class Form
{
    const INPUT_LENGTH = [
        'username' => [
            'minlength' => 6,
            'maxlength' => 12
        ],
        'password' => [
            'minlength' => 6,
            'maxlength' => 12
        ]
    ];

    /**
     * @var string $action
     */
    private $action;

    //const IDENTIFIER_PATTERN = "/^([A-Z][a-zA-Z]+)Form$/";

    /**
     * @var UserModel $user
     */
    protected $user;

    /** @var InputField[]|null $inputs */
    protected $inputs;

    /** @var bool $state */
    private $state = true;

    /** @var string $identifier */
    private $identifier;

    /**
     * Form constructor.
     * @param array $inputs
     * @throws \ReflectionException
     */
    protected function __construct(array $inputs)
    {
        $this->inputs = $inputs;
        $this->identifier = $this->getIdentifier();
    }

    /**
     * @return InputField[]|null
     */
    public function getInputs(): ?array
    {
        return $this->inputs;
    }

    /**
     * @param array $values
     * @return Form
     */
    public function setInputValues(array $values): Form
    {
        foreach ($this->inputs as $input) {
            $value = ArrayHelper::getValue($values,  $input->getName());
            $input->setValue($value);
        }

        return $this;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getInputValue(string $name): ?string
    {
        /**
         * @var InputField $input
         */
        $input = ArrayHelper::getValue($this->inputs, $name);

        return $input ? $input->getValue() : $input;
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
     * @return Form
     */
    public function setState(bool $state): Form
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param string $name
     * @return InputField|null
     */
    public function getInput(string $name): ?InputField
    {
        return ArrayHelper::getValue($this->inputs, $name);
    }

    /**
     * @param string $action
     * @return Form
     */
    public function setAction(string $action): Form
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    private function getIdentifier()
    {
        $replacement = [
            '^([A-Z][a-z]+)([A-Z][a-z]+)Form$' => '$1/$2',
            '^([A-Z][a-zA-Z]+)Form$' => '$1'
            ];

        foreach ($replacement as $pattern => $value) {
            if (preg_match("/$pattern/", ClassHelper::getShortName($this))) {
                $res = preg_replace("/$pattern/", $value, ClassHelper::getShortName($this));
                break;
            }
        }

        return implode('-', array_map('lcfirst', explode('/', $res)));
    }
}
