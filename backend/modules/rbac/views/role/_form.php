<?php

use backend\widgets\ActiveForm;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
sssssssssssssssss
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticSubmitButton() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>