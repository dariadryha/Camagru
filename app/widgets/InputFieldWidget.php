<?php
namespace app\widgets;

use app\helpers\builders\FormBuilder;
use app\helpers\builders\HtmlBuilder;
use app\models\forms\InputField;

class InputFieldWidget
{
    private $input;

    private $attributes = [
        'type',
        'name',
        'id',
        'minlength',
        'maxlength',
        'autocomplete',
    ];

    public function __construct(InputField $input)
    {
        $this->input = $input;
        $this->attributes = array_fill_keys($this->attributes, null);
        ob_start();
        //ob_start([$this, 'obHandler']);
    }
//
//    /**
//     * @param string $buffer
//     * @return string
//     */
//    private function obHandler(string $buffer): string
//    {
//        return require PATH_WIDGETS_VIEWS . 'forms/input-wrap.php';
//    }

    private function input(string $type, array $attributes = [])
    {
        $this->attributes = $this->handleAttributes($attributes, $type);

        $this->render();

        return $this;
    }

    public function render()
    {
        require PATH_WIDGETS_VIEWS . 'forms/input-block.php';

        ob_end_flush();
    }

    /**
     * @param array $attributes
     * @param string $type
     * @return array
     */
    private function handleAttributes(array $attributes, string $type): array
    {
        $this->attributes = array_merge($this->attributes, array_merge($attributes, $this->input->getAttributes()));
        $this->attributes['type'] = $type;
        $this->attributes['id'] = "id_{$this->attributes['name']}";

        return array_filter($this->attributes);
    }

    public function textInput(array $attributes = [])
    {
        $this->input('text', $attributes);
    }

    public function emailInput(array $attributes = [])
    {
        $this->input('email', $attributes);
    }

    public function passwordInput(array $attributes = [])
    {
        $this->attributes['autocomplete'] = 'off';

        $this->input('password', $attributes);
    }

    public static function submitInput(array $attributes = [])
    {
        echo FormBuilder::buildInput(array_merge($attributes, ['type' => 'submit', 'name' => 'submit', 'id' => 'submit']));
    }
}