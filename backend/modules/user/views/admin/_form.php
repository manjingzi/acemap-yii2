<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\Admin;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->status = Admin::STATUS_ACTIVE;
}
Pjax::begin();
?>
<div class="box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?php
        if ($model->isNewRecord) {
            ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
        <?php } else { ?>
            <div class="form-group">
                <label class="col-lg-2 control-label"><?= Yii::t('app', 'Username') ?></label>
                <div class="col-lg-7">
                    <p class="form-control-static"><?= $model->username ?></p>
                </div>
            </div>
        <?php } ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->radioList(Admin::getStatusText()) ?>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-7 col-md-offset-2">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
Pjax::end();
