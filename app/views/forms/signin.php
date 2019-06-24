<?php
use \app\helpers\builders\FormBuilder;
echo FormBuilder::renderForm(
    $models['signin'],
    [
        'action' => '/signin/login',
        'method' => 'post'
    ]
);