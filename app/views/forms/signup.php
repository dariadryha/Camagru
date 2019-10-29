<?php
use app\models\forms\Form;
use app\widgets\FormWidget;
use app\widgets\InputFieldWidget;
use app\widgets\FlashMessageWidget;
use app\widgets\ButtonWidget;

/** @var Form $model */
?>

<?php $form = FormWidget::begin(['action' => '/signup/signup', 'method' => 'post']); ?>
    <?= $form->field($model, 'username')->textInput(); ?>
    <?= $form->field($model, 'email')->emailInput(); ?>
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= $form->field($model, 'confirm_password')->passwordInput(); ?>
    <?= ButtonWidget::submit('Sign Up'); ?>
<?php $form->end(); ?>