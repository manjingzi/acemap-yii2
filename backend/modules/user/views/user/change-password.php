<?php

use common\extensions\Btn;
use backend\widgets\ActiveForm;

$title = Yii::t('app', 'System user');
$label = Yii::t('app', 'Change password');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= Btn::staticText(Yii::t('app', 'Username'), $model->username) ?>
        <?= $form->password('newPassword', $model) ?>
        <?= $form->password('confirmPassword', $model) ?>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <?= Btn::changePasswordSubmitButton() ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>