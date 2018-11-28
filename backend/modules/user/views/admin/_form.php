<?php

use common\models\Admin;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->status = Admin::STATUS_ACTIVE;
}
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?php if ($model->isNewRecord) { ?>
            <?= $form->text('username', $model) ?>
            <?= $form->password('new_password', $model) ?>
            <?= $form->password('confirm_password', $model) ?>
        <?php } else { ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Username'), $model->username); ?>
        <?php } ?>
        <?= $form->text('email', $model) ?>
        <?= $form->radioList('status', $model, Admin::getStatusText()) ?>
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticSubmitButton($model->isNewRecord) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
