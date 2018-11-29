<?php

use yii\helpers\Url;
use yii\widgets\DetailView;
use backend\widgets\ActiveForm;

$labels = $this->context->labels();
$this->title = Yii::t('app', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', $labels['Items']), 'url' => ['index']];
?>
<div class="box box-primary">
    <div class="box-header with-border">
<?= ActiveForm::staticHrefButton(ActiveForm::CREATE_UPDATE_DELETE, $model->name) ?>
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'description:ntext',
                'ruleName',
                'data:ntext',
            ],
            'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
        ]);
        ?>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Yii::t('app', 'Operation') ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-5">
                <input class="form-control" placeholder="<?= Yii::t('app/rbac', 'Search for available') ?>">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <input class="form-control" placeholder="<?= Yii::t('app/rbac', 'Search for assigned') ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <select size="15" class="form-control" data-target="available" multiple="multiple"></select>
            </div>
            <div class="col-md-2">
                <div class="text-center">
                    <p><button data-target="available" data-href="<?= Url::to(['assign', 'id' => $model->name]) ?>" class="btn btn-success btn-assign"><i class="fa fa-share"></i></button></p>
                    <p><button data-target="assigned" data-href="<?= Url::to(['remove', 'id' => $model->name]) ?>" class="btn btn-danger btn-assign"><i class="fa fa-reply"></i></button></p>
                </div>
            </div>
            <div class="col-md-5">
                <select size="15" class="form-control" data-target="assigned" multiple="multiple"></select>
            </div>
        </div>
    </div>
</div>