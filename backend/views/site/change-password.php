<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'Change password');
Pjax::begin();
?>
<div class="box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="form-group">
            <label class="col-lg-2 control-label"><?= Yii::t('app', 'Username') ?></label>
            <div class="col-lg-7">
                <p class="form-control-static"><?= Yii::$app->user->identity->username ?></p>
            </div>
        </div>
        <?= $form->field($model, 'oldPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true]) ?>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <div class="col-lg-7 col-md-offset-2">
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
Pjax::end();
