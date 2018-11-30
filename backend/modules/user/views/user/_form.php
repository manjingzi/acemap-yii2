<?php

use common\extensions\Btn;
use common\models\User;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->status = User::STATUS_ACTIVE;
}
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?php if ($model->isNewRecord) { ?>
            <?= $form->text('username', $model) ?>
            <?= $form->password('newPassword', $model) ?>
            <?= $form->password('confirmPassword', $model) ?>
        <?php } else { ?>
            <?= Btn::staticText(Yii::t('app', 'Username'), $model->username); ?>
        <?php } ?>
        <?= $form->text('email', $model) ?>
        <?= $form->radioListStatus($model) ?>
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
