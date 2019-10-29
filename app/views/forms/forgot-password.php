<?php
use app\models\forms\Form;
use app\widgets\FormWidget;
use app\widgets\InputFieldWidget;
use app\helpers\builders\HtmlBuilder;
/** @var Form $model */
?>
<?php $form = FormWidget::begin(['action' => '/forgot-password/reset-password', 'method' => 'post']); ?>
    <?= $form->field($model, 'username')->textInput(); ?>
    <?= InputFieldWidget::submitInput(); ?>
<?php $form->end(); ?>