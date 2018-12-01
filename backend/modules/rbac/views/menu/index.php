<?php

use yii\widgets\Pjax;
use common\extensions\Btn;
use common\models\AuthMenu;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$title = Yii::t('app/rbac', 'Menus');
$label = Yii::t('app', 'List');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
$keyword = AuthMenu::getSearchParams('keyword');
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
                <?= $form->dropDownList('pid', $searchModel, AuthMenu::formatDropDownList()) ?>
                <?= $form->selectStatus($searchModel, Yii::t('app/rbac', 'Display State')) ?>
                <?= $form->searchKeyword($searchModel) ?>
                <?= Btn::resetButton() ?>
                <?= Btn::searchSubmitButton() ?>
                <?php SearchForm::end(); ?>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right"><?= Btn::createHrefButton() ?></div>
                <h3 class="box-title"><?= $label ?></h3>
            </div>
            <div class="box-body">
                <?php Pjax::begin(); ?>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'attribute' => 'id'
                        ],
                        [
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->name) : $model->name;
                            }
                        ],
                        [
                            'attribute' => 'route',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->route) : $model->route;
                            }
                        ],
                        'order',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function($model) {
                                return AuthMenu::getStatusIcon($model->status);
                            },
                        ],
                        [
                            'class' => 'backend\widgets\ActionColumn',
                            'header' => Yii::t('app', 'Operation'),
                            'template' => '{delete} {update} {view}',
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>