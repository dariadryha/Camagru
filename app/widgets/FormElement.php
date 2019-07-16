<?php
namespace app\widgets;

class FormElement implements Widget
{
    public static function render()
    {
        require PATH_VIEWS_FORMS_WIDGETS . 'form-element.php';
    }
}