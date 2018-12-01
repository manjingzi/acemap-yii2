<?php

use common\extensions\Btn;
use common\models\AuthMenu;

$title = Yii::t('app/rbac', 'Menus');
$label = Yii::t('app', 'View');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="pull-right">
            <?= Btn::deleteHrefButton($model->id) ?>
            <?= Btn::updateHrefButton($model->id) ?>
            <?= Btn::createHrefButton() ?>
        </div>
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <div class="box-body">
        <div class="form-horizontal">
            <?= Btn::staticText(Yii::t('app', 'Name'), $model->name) ?>
            <?= Btn::staticText(Yii::t('app', 'Pid'), $model->pid ? $model->pname->name : '-') ?>
            <?= Btn::staticText(Yii::t('app/rbac', 'Route'), $model->route) ?>
            <?= Btn::staticText(Yii::t('app', 'Order'), $model->order) ?>
            <?= Btn::staticText(Yii::t('app', 'Status'), AuthMenu::getStatusIcon($model->status)) ?>
        </div>
    </div>
</div>