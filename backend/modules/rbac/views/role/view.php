<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Roles'), 'url' => ['index']];
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="form-horizontal">
        <div class="box-body">
            <?= ActiveForm::staticText(Yii::t('app', 'Name'), $model->name) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Description'), $model->description) ?>
            <?= ActiveForm::staticText(Yii::t('app/rbac', 'Rule Name'), $model->ruleName) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Created At'), date('Y-m-d H:i:s', $model->createdAt)) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Updated At'), date('Y-m-d H:i:s', $model->updatedAt)) ?>
        </div>
        <div class="box-footer">
            <?= ActiveForm::staticHrefButton(ActiveForm::UPDATE_DELETE, $model->name) ?>
        </div>
    </div>
</div>