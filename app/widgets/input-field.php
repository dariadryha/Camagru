<?php
    use app\helpers\builders\FormBuilder;
    use app\models\forms\InputField;
    /*  @var InputField $input */
?>
<div class="row">
    <div class="col-sm-6 col-md-4 form-group nopadding">
        <?php
            echo FormBuilder::buildLabel(['for' => $input->getName()], $input->getLabel());
            echo FormBuilder::buildInput(array_merge($input->getAttributes(), ['class' => 'form-control']));
            if ($error = $input->getError())
                echo FormBuilder::buildSpan(['class' => "error"], $error);
        ?>
    </div>
</div>