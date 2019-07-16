<?php
namespace app\widgets;

class FormWidget implements Widget
{
    public static function render()
    {
        require PATH_VIEWS_FORMS_WIDGETS . 'form.php';
    }
}