<?php
/*  @var array $models */

use \app\helpers\builders\FormBuilder;
echo FormBuilder::buildBeginForm(
    [
        'action' => 'change/change',
        'method' => 'post'
    ]
);
echo FormBuilder::renderFormContent($models['change']);
echo FormBuilder::renderFormContent($models['reset']);
echo FormBuilder::buildEndForm();