<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Roles'), 'url' => ['index']];
$data = $model->findRoleModel();
//$childRoles = $model->getChildRoles();
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <?= ActiveForm::staticHrefButton(ActiveForm::CREATE_UPDATE_DELETE, $data->name) ?>
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">
        <div class="form-horizontal">
            <?= ActiveForm::staticText(Yii::t('app', 'Name'), $data->name) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Description'), $data->description ?: Yii::t('yii', '(not set)')) ?>
            <?= ActiveForm::staticText(Yii::t('app/rbac', 'Rule Name'), $data->ruleName ?: Yii::t('yii', '(not set)')) ?>
        </div>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-5">
                <input class="form-control" placeholder="Search for available">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5"></div>
        </div>
    </div>
</div>