<?php

use yii\widgets\Breadcrumbs;
use yii\bootstrap\Alert;

$home = ['label' => '<i class="fa fa-home"></i> ' . Yii::t('app', 'Home'), 'url' => Yii::$app->homeUrl, 'encode' => false];
$links = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
$links[] = $this->title;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $this->title ?></h1>
        <?= Breadcrumbs::widget(['homeLink' => $home, 'links' => $links]) ?>
    </section>
    <section class="content">
        <?php
        if (Yii::$app->getSession()->hasFlash('success')) {
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-success', //这里是提示框的class
                ],
                'body' => Yii::$app->getSession()->getFlash('success'), //消息体
            ]);
        }
        if (Yii::$app->getSession()->hasFlash('error')) {
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-error',
                ],
                'body' => Yii::$app->getSession()->getFlash('error'),
            ]);
        }
        ?>
        <?= $content ?>
    </section>
</div>
