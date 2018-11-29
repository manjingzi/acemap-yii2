<?php

use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Roles'), 'url' => ['index']];
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->text('name', $model) ?>
        <?= $form->text('description', $model) ?>
        <?= $form->text('rule_name', $model) ?>
    </div>
    <div class="box-footer">
        <?= ActiveForm::staticSubmitButton() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>