<?php
use app\models\forms\Form;
use app\widgets\FormWidget;
use app\widgets\InputFieldWidget;
/**
 * @var Form $model
 */
?>
<?php $form = FormWidget::begin(['action' => '/edit-profile/edit-profile', 'method' => 'post']); ?>
<?= $form->field($model, 'username')->textInput(); ?>
<?= $form->field($model, 'email')->emailInput(); ?>
<?= InputFieldWidget::submitInput(); ?>
<?php $form->end(); ?>
