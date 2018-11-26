<?php

use yii\helpers\Html;
use common\models\UserAcountLog;
use backend\widgets\ActiveForm;

$this->title = '用户账户管理';
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($acount, 'user_id')->hiddenInput(['value' => $model->c_user_id])->label(false); ?>
    <div class="box-body">
        <div class="form-group">
            <label class="col-lg-2 control-label">用户名</label>
            <div class="col-lg-7">
                <p class="form-control-static"><?= $model->user->c_user_name ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">现金账户金额</label>
            <div class="col-lg-7">
                <p class="form-control-static"><?= $model->c_amount ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">冻结账户金额</label>
            <div class="col-lg-7">
                <p class="form-control-static"><?= $model->c_frozen_amount ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">用户积分</label>
            <div class="col-lg-7">
                <p class="form-control-static"><?= $model->c_point ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">用户经验值</label>
            <div class="col-lg-7">
                <p class="form-control-static"><?= $model->c_exp ?></p>
            </div>
        </div>
        <?= $form->field($acount, 'type')->dropDownList(UserAcountLog::getType(), ['prompt' => '选择类型']) ?>
        <?= $form->field($acount, 'amount')->textInput(['maxlength' => true]) ?>   
        <?= $form->field($acount, 'frozen_amount')->textInput(['maxlength' => true]) ?>   
        <?= $form->field($acount, 'point')->textInput(['maxlength' => true]) ?>   
        <?= $form->field($acount, 'exp')->textInput(['maxlength' => true]) ?>   
    </div>
    <div class="modal-footer">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>