<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Admin;
use common\extensions\Util;
use backend\widgets\GridView;
use backend\widgets\SearchForm;
use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'System user'), 'url' => ['index']];
$keyword = Admin::getSearchParams('keyword');
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
                <?= $form->field($searchModel, 'pagesize')->dropDownList(Admin::getPageSize(), ['prompt' => Yii::t('app', 'Select page number'), 'value' => Admin::getSearchParams('pagesize')]) ?>
                <?= $form->field($searchModel, 'status')->dropDownList(Admin::getStatusText(), ['prompt' => Yii::t('app', 'Selection status'), 'value' => Admin::getSearchParams('status')]) ?>
                <?= $form->field($searchModel, 'keyword')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Please enter keywords'), 'value' => $keyword]) ?>
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Reset'), Url::to(['index']), ['class' => 'btn btn-default']) ?>
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
                            'attribute' => 'id'
                        ],
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->username) : $model->username;
                            }
                        ],
                        [
                            'attribute' => 'email',
                            'format' => 'raw',
                            'value' => function($model) use($keyword) {
                                return $keyword ? Util::highlight($keyword, $model->email) : $model->email;
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function($model) {
                                return Admin::getStatusIcon($model->status);
                            },
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s']
                        ],
                        [
                            'class' => 'backend\widgets\ActionColumn',
                            'header' => Yii::t('app', 'Operation'),
                            'template' => '{delete} {update} {view}',
                            'visibleButtons' => [
                                'update' => function ($model) {
                                    return !Admin::checkSuperUser($model->id);
                                },
                                'delete' => function ($model) {
                                    return !Admin::checkSuperUser($model->id);
                                },
                            ]
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>