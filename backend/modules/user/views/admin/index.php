<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\web\View;
use common\models\Admin;
use common\extensions\Util;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$this->title = Yii::t('backend-admin', 'title');
$keyword = Admin::getSearchParams('keyword');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('backend-layouts', 'search') ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $form = SearchForm::begin(); ?>
                <?= $form->field($searchModel, 'pagesize')->dropDownList(Admin::getPageSize(), ['prompt' => Yii::t('backend-layouts', 'select-page-number'), 'value' => Admin::getSearchParams('pagesize')]) ?>
                <?= $form->field($searchModel, 'status')->dropDownList(Admin::getStatusText(), ['prompt' => Yii::t('backend-layouts', 'select-status'), 'value' => Admin::getSearchParams('status')]) ?>
                <?= $form->field($searchModel, 'keyword')->textInput(['maxlength' => true, 'placeholder' => Yii::t('backend-layouts', 'search-keyword'), 'value' => $keyword]) ?>
                <?= Html::submitButton(Yii::t('backend-layouts', 'search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('backend-layouts', 'reset'), Url::to(['index']), ['class' => 'btn btn-default']) ?>
                <div class="pull-right">
                    <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('backend-layouts', 'create'), Url::to(['create']), ['class' => 'btn btn-success']) ?>
                </div>
                <?php SearchForm::end(); ?>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Yii::t('backend-layouts', 'list') ?></h3>
            </div>
            <div class="box-body">
                <?php Pjax::begin(); ?> 
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'headerOptions' => ['style' => 'min-width:50px']
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
                            'header' => Yii::t('backend-layouts', 'operation'),
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url) {
                                    $options = ['title' => Yii::t('backend-layouts', 'view'), 'class' => 'btn btn-sm btn-primary'];
                                    return Html::a('<i class="fa fa-eye"></i>', $url, $options);
                                },
                            ],
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
<?php $this->beginBlock('js') ?>
    $(function () {

    });
<?php $this->endBlock() ?>
</script>
<?php
$this->registerJs($this->blocks['js'], View::POS_LOAD);
