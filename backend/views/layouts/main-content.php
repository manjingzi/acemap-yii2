<?php

use yii\widgets\Breadcrumbs;

$home = ['label' => '<i class="fa fa-home"></i> ' . Yii::t('app', 'Home'), 'url' => Yii::$app->homeUrl, 'encode' => false];
$links = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
?>
<div class="content-wrapper">
    <section class="content-header">
        <?= Breadcrumbs::widget(['homeLink' => $home, 'links' => $links]) ?>
    </section>
    <section class="content">
        <?= $this->render('alert') ?>
        <?= $content ?>
    </section>
</div>
