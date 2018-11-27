<?php

use backend\widgets\ActiveForm;
use common\models\Admin;

$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'System user'), 'url' => ['index']];
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <!--需加上<div class="form-horizontal"></div>-->
    <div class="form-horizontal">
        <div class="box-body">
            <?= ActiveForm::staticText(Yii::t('app', 'Username'), $model->username) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Email'), $model->email) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Created At'), date('Y-m-d H:i:s', $model->created_at)) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Updated At'), date('Y-m-d H:i:s', $model->updated_at)) ?>
            <?= ActiveForm::staticText(Yii::t('app', 'Status'), Admin::getStatusIcon($model->status)) ?>
        </div>
        <?php if (!Admin::checkSuperUser($model->id)) { ?>
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <?= ActiveForm::staticDeleteButton($model->id) ?>
                        <?= ActiveForm::staticUpdateButton($model->id) ?>
                        <?= ActiveForm::staticPasswordButton($model->id) ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>