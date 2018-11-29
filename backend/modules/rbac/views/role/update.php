<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Roles'), 'url' => ['index']];

$data = $model->findRoleModel();
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->staticText(Yii::t('app', 'Name'), $data->name) ?>
        <?= $form->text('description', $model, $data->description) ?>
        <?= $form->text('rule_name', $model, $data->ruleName) ?>
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticSubmitButton(false) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
