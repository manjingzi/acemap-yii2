<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Roles'), 'url' => ['index']];
$data = $model->findRoleModel();
//$childRoles = $model->getChildRoles();
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="form-horizontal">
        <div class="box-body">
            <?= ActiveForm::staticText(Yii::t('app', 'Name'), $data->name) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Description'), $data->description) ?>
            <?= ActiveForm::staticText(Yii::t('app/rbac', 'Rule Name'), $data->ruleName) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Created At'), date('Y-m-d H:i:s', $data->createdAt)) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Updated At'), date('Y-m-d H:i:s', $data->updatedAt)) ?>
        </div>
        <div class="box-body">

        </div>
        <div class="box-footer">
            <?= ActiveForm::staticHrefButton(ActiveForm::UPDATE_DELETE, $data->name) ?>
        </div>
    </div>
</div>