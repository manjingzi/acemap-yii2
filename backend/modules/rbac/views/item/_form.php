<?php

use common\extensions\Btn;
use backend\widgets\ActiveForm;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->text('name', $model) ?>
        <?= $form->textarea('description', $model) ?>
        <?= $form->text('ruleName', $model) ?>
        <?= $form->textarea('data', $model, 6) ?>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <?= $model->isNewRecord ? Btn::createSubmitButton() : Btn::updateSubmitButton() ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>