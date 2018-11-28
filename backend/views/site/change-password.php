<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Change password');
?>
<div class="box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= ActiveForm::staticText(Yii::t('app', 'Username'), Yii::$app->user->identity->username) ?>
        <?= $form->password('old_password', $model) ?>
        <?= $form->password('new_password', $model) ?>
        <?= $form->password('confirm_password', $model) ?>
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticSubmitButton(false) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
