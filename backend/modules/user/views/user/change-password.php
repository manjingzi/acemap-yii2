<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Change password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System user'), 'url' => ['index']];
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= ActiveForm::staticText(Yii::t('app', 'Username'), $model->username) ?>
        <?= $form->password('newPassword', $model) ?>
        <?= $form->password('confirmPassword', $model) ?>
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticPasswordSubmitButton() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>