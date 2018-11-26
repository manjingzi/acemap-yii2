<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;

$this->title = '用户密码修改';
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="form-group">
            <label class="col-lg-2 control-label">用户名</label>
            <div class="col-lg-7">
                <p class="form-control-static"><?= $model->c_user_name ?></p>
            </div>
        </div>
        <?= $form->field($model, 'new_password')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'new_password_confirm')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton('修改', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
