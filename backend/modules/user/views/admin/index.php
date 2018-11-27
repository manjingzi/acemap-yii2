<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
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
        <div class="box">
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

        <div class="box">
            <div class="box-header">
                <div class="pull-right"><?= ActiveForm::staticCreateButton() ?></div>
                <h3 class="box-title"><?= Yii::t('app', 'List') ?></h3>
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
                            'class' => 'backend\widgets\ActionColumn',
                            'header' => Yii::t('app', 'Operation'),
                            'template' => '{view} {update}',
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>