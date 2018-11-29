<?php

use backend\widgets\ActiveForm;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->text('name', $model) ?>
        <?= $form->textarea('description', $model) ?>
        <?= $form->text('ruleName', $model) ?>
        <?= $form->textarea('data', $model, 6) ?>
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticSubmitButton($model->isNewRecord) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>