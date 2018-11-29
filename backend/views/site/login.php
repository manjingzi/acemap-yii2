<?php

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Administrator login');
?>
<div class="login-box">
    <div class="login-logo"><b><?= Yii::t('app', 'Administrator login') ?></b></div>
    <div class="login-box-body">
        <p class="login-box-msg"><?= Yii::t('app', 'Sign in to start your session') ?></p>
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => Yii::t('app/error', 'Please enter your username'), 'class' => 'form-control']])->textInput(['autofocus' => true, 'maxlength' => true])->label(false) ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => Yii::t('app/error', 'Please enter your password'), 'class' => 'form-control']])->passwordInput(['maxlength' => true])->label(false) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-xs-4"><button type="submit" class="btn btn-primary btn-block btn-flat"><?= Yii::t('app', 'Sign in') ?></button></div>
        </div>
        <div class="social-auth-links">
            <p><?= Yii::t('app', 'Switch language') ?></p>
            <p>
                <?php
                $array = Yii::$app->params['site_lang'];
                //不显示当前语言
                foreach ($array as $lang) {
                    if ($lang !== Yii::$app->session->get('lang')) {
                        ?>
                        <a href="<?= Url::to(['/site/lang', 'lang' => $lang]) ?>"> <?= Yii::t('app', $lang) ?></a> 
                        <?php
                    }
                }
                ?>
            </p>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
