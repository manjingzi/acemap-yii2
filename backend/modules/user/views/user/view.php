<?php

use backend\widgets\ActiveForm;
use common\models\User;

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System user'), 'url' => ['index']];
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <?php if (!User::checkSuperUser($model->id)) { ?>
            <div class="pull-right">
                <?= ActiveForm::staticDeleteButton($model->id) ?>
                <?= ActiveForm::staticPasswordButton($model->id) ?>
                <?= ActiveForm::staticUpdateButton($model->id) ?>
                <?= ActiveForm::staticCreateButton() ?>
            </div>
        <?php } ?>
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <!--需加上<div class="form-horizontal"></div>-->
    <div class="box-body">
        <div class="form-horizontal">
            <?= ActiveForm::staticText(Yii::t('app', 'Username'), $model->username) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Email'), $model->email) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Created At'), date('Y-m-d H:i:s', $model->created_at)) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Updated At'), date('Y-m-d H:i:s', $model->updated_at)) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Status'), User::getStatusIcon($model->status)) ?>
        </div>
    </div>
</div>