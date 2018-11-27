<?php

use common\models\Admin;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->status = Admin::STATUS_ACTIVE;
}
?>
<div class="box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?php if ($model->isNewRecord) { ?>
            <?= $form->text('username', $model) ?>
            <?= $form->password('newPassword', $model) ?>
            <?= $form->password('confirmPassword', $model) ?>
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
