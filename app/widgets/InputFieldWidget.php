<?php
namespace app\components;

use app\helpers\builders\FormBuilder;

class InputFieldWidget implements Widget
{
    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public static function render($input)
    {
        FormBuilder::buildInput($input->getAttributes());
        //require PATH_VIEWS . 'widgets/input-field.php';
    }
}