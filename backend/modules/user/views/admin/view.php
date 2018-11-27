<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'System user'), 'url' => ['index']];
?>
<div class="box">
    <div class="form-horizontal">
        <div class="box-body">
            <?= ActiveForm::staticText(Yii::t('app', 'Username'), $model->username) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Email'), $model->email) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Created At'), date('Y-m-d H:i:s', $model->created_at)) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Updated At'), date('Y-m-d H:i:s', $model->updated_at)) ?>
        </div>
        <div class="box-footer">
            <?= ActiveForm::staticHrefButton(ActiveForm::UPDATE_DELETE, $model->id) ?>
        </div>
    </div>
</div>