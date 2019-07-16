<?php
namespace app\components;

class FormWidget implements Widget
{
    public static function render()
    {
        echo $model->getAction();
    }
}