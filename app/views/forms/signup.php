<?php
use \app\helpers\builders\FormBuilder;
echo FormBuilder::renderForm(require PATH_VIEWS_FORMS_CONFIG .'SignupForm.php',
    $models['signup']
);