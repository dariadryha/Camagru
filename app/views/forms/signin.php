<?php
use app\models\forms\Form;
use app\widgets\FormWidget;
use app\widgets\ButtonWidget;

/** @var Form $model */
?>
<?php $form = FormWidget::begin(['action' => '/signin/signin', 'method' => 'post']); ?>
    <?= $form->field($model, 'username')->textInput(); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= ButtonWidget::submit('Sign In'); ?>
<?php $form->end(); ?>
