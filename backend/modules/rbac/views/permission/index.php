<?php

use common\models\AuthItem;
use common\extensions\Util;
use backend\widgets\GridView;
use backend\widgets\SearchForm;
use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Permissions'), 'url' => ['index']];
$keyword = AuthItem::getSearchParams('keyword');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('app', 'Search') ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $form = SearchForm::begin(); ?>
                <?= $form->selectPagesize($searchModel) ?>
                <?= $form->searchKeyword($searchModel) ?>
                <?= ActiveForm::staticHrefButton(ActiveForm::RESET) ?>
                <?= ActiveForm::staticButton(ActiveForm::SEARCH) ?>
                <?php SearchForm::end(); ?>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right"><?= ActiveForm::staticCreateButton() ?></div>
                <h3 class="box-title"><?= $this->title ?></h3>
            </div>
            <div class="box-body">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->name) : $model->name;
                            }
                        ],
                        [
                            'attribute' => 'rule_name',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->rule_name) : $model->rule_name;
                            }
                        ],
                        [
                            'attribute' => 'description',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->description) : $model->description;
                            }
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        [
                            'class' => 'backend\widgets\ActionColumn',
                            'header' => Yii::t('app', 'Operation'),
                            'template' => '{delete} {update} {view}'
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>