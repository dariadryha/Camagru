<?php
    use app\helpers\builders\FormBuilder;
    use app\models\forms\Form;
    /*  @var Form $model */
?>
<div class="container">
    <?php echo FormBuilder::buildBeginForm(['action' => $model->getAction(), 'method' => $model->getMethod()]); ?>
    <?php if (!$model->getState()): ?>
    <div class="row">
        <div class="col-sm-6 col-md-4 form-group nopadding">
            <?php echo FormBuilder::buildDiv(['class' => "'alert alert-danger'"], 'Oops! Something went wrong.'); ?>
        </div>
    </div>
    <?php endif; ?>
    <?php
        $inputs = $model->getInputs();
        foreach ($inputs as $input) {
            require PATH_VIEWS . 'widgets/input-field.php';
        }
     ?>
    <div class="row">
    <div class="col-sm-6 col-md-4 form-group nopadding">
        <button type="submit" class="btn btn-primary btn-block"><?=$model->getValue(); ?></button>
    </div>
    </div>
    <?php echo FormBuilder::buildEndForm(); ?>
</div>