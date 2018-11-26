<?php

use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Administrator login');
Pjax::begin();
?>
<div class="login-box">
    <div class="login-logo"><b><?= Yii::t('app', 'Administrator login') ?></b></div>
    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('app', 'Sign in to start your session') ?></p>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => [
                        'data' => ['pjax' => true]
                    ],
        ]);
        ?>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => Yii::t('app', 'Please enter your username'), 'class' => 'form-control']])->textInput(['autofocus' => true])->label(false) ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => Yii::t('app', 'Please enter your password'), 'class' => 'form-control']])->passwordInput()->label(false) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-xs-4"><button type="submit" class="btn btn-primary btn-block btn-flat"><?= Yii::t('app', 'Sign in') ?></button></div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
Pjax::end();
?>