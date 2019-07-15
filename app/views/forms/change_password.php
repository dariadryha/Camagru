<?php
/*  @var array $models */

use \app\helpers\builders\FormBuilder;
echo FormBuilder::buildBeginForm(['action' => $models['change']->getAction(), 'method' => $models['change']->getMethod()]);
echo FormBuilder::renderInputs($models['change']);
echo FormBuilder::renderInputs($models['reset']);
echo FormBuilder::renderButton($models['change']);
echo FormBuilder::buildEndForm();