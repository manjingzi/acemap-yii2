<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

$title = Yii::t('app', 'System user');
$label = Yii::t('app/rbac', 'Assign authority');
$this->title = $title . ' - ' . $label . ' - ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['/user/user/index']];
$this->params['breadcrumbs'][] = $label;
$this->params['breadcrumbs'][] = $model->username;
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
$opts = Json::htmlEncode(['items' => $model->getItems()]);
$this->registerJs('var _opts = ' . $opts . ';');
$this->registerJs($this->render('_script.js'));
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-5">
                <input class="form-control search" data-target="available" placeholder="<?= Yii::t('app/rbac', 'Search for available') ?>">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <input class="form-control search" data-target="assigned" placeholder="<?= Yii::t('app/rbac', 'Search for assigned') ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <select size="15" class="form-control list" data-target="available" multiple="multiple"></select>
            </div>
            <div class="col-md-2">
                <div class="text-center">
                    <p>
                        <?=
                        Html::button('&gt;&gt;' . $animateIcon, [
                            'class' => 'btn btn-success btn-assign',
                            'data-href' => Url::to(['assign', 'id' => $model->id]),
                            'data-target' => 'available',
                            'title' => Yii::t('app/rbac', 'Assign'),
                        ]);
                        ?>
                    </p>
                    <p>
                        <?=
                        Html::button('&lt;&lt;' . $animateIcon, [
                            'class' => 'btn btn-danger btn-assign',
                            'data-href' => Url::to(['remove', 'id' => $model->id]),
                            'data-target' => 'assigned',
                            'title' => Yii::t('app', 'Remove'),
                        ]);
                        ?>
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <select size="15" class="form-control list" data-target="assigned" multiple="multiple"></select>
            </div>
        </div>
    </div>
</div>