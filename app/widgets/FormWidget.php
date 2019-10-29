<?php
namespace app\widgets;

use app\helpers\builders\FormBuilder;
use app\models\forms\Form;

class FormWidget
{
    public static function begin(array $attributes = [])
    {
        $instance = new self();

        ob_start([$instance, 'obHandler']);
        echo FormBuilder::buildBeginForm($attributes);

        return $instance;
    }

    /**
     * @param string $buffer
     * @return string
     */
    private function obHandler(string $buffer): string
    {
        return require PATH_WIDGETS_VIEWS . 'forms/form-wrap.php';
    }

    public function end()
    {
        echo FormBuilder::buildEndForm();

        ob_get_flush();
    }

    /**
     * @param Form $form
     * @param string $name
     * @return InputFieldWidget
     */
    public function field(Form $form, string $name)
    {
        return new InputFieldWidget($form->getInput($name));
    }
}