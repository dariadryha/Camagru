<?php
use app\helpers\builders\HtmlBuilder;
?>
<div class="form-group">
    <label for=<?= $this->attributes['id'] ?>><?= $this->input->getLabel() ?></label>
    <input class="form-control rounded-0" <?= HtmlBuilder::buildAttributes($this->attributes) ?>>
    <?php if (!$this->input->getState()): ?>
        <p class="text-danger font-italic font-weight-light"><?= $this->input->getError() ?></p>
    <?php endif; ?>
</div>
