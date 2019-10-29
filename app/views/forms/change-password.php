<?php
use app\models\forms\Form;
use app\widgets\FormWidget;
use app\widgets\InputFieldWidget;

/**
 * @var array $model
 */
extract($model);
/**
 * @var Form $changePassword
 * @var Form $resetPassword
 */
?>
<?php $form = FormWidget::begin(['action' => '/change-password/change-password', 'method' => 'post']); ?>
<?= $form->field($changePassword, 'password')->passwordInput(); ?>
<?= $form->field($resetPassword, 'password')->passwordInput(); ?>
<?= $form->field($resetPassword, 'confirm_password')->passwordInput(); ?>
<?= InputFieldWidget::submitInput(); ?>
<?php $form->end(); ?>