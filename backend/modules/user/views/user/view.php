<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\extensions\Btn;
use common\models\User;

$title = Yii::t('app', 'System user');
$label = Yii::t('app', 'View');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <?php if (!User::checkSuperUser($model->id)) { ?>
            <div class="pull-right">
                <?= Btn::deleteHrefButton($model->id) ?>
                <?= Html::a('<i class="fa fa-cog"></i> ' . Yii::t('app/rbac', 'Assign authority'), Url::to(['/rbac/assignment/view', 'id' => $model->id]), ['class' => 'btn btn-success']); ?>
                <?= Btn::changePasswordHrefButton($model->id) ?>
                <?= Btn::updateHrefButton($model->id) ?>
                <?= Btn::createHrefButton() ?>
            </div>
        <?php } ?>
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <div class="box-body">
        <div class="form-horizontal">
            <?= Btn::staticText(Yii::t('app', 'Username'), $model->username) ?>
            <?= Btn::staticText(Yii::t('app', 'Email'), $model->email) ?>
            <?= Btn::staticText(Yii::t('app', 'Created At'), date('Y-m-d H:i:s', $model->created_at)) ?>
            <?= Btn::staticText(Yii::t('app', 'Updated At'), date('Y-m-d H:i:s', $model->updated_at)) ?>
            <?= Btn::staticText(Yii::t('app', 'Status'), User::getStatusIcon($model->status)) ?>
        </div>
    </div>
</div>