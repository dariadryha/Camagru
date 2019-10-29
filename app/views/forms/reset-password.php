<?php
use app\models\forms\Form;
use app\widgets\FormWidget;
use app\widgets\InputFieldWidget;
/**
 * @var Form $model
 */
?>
<?php $form = FormWidget::begin(['action' => $model->getAction(), 'method' => 'post']); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= $form->field($model, 'confirm_password')->passwordInput(); ?>
    <?= InputFieldWidget::submitInput(); ?>
<?php $form->end(); ?>
