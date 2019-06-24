<?php
use \app\helpers\builders\FormBuilder;
echo FormBuilder::renderForm(
    $models['signup'],
    [
        'action' => 'signup/register',
        'method' => 'post'
    ]
);