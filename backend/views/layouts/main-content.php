<?php

use yii\widgets\Breadcrumbs;

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
        <?= $this->render('alert') ?>
        <?= $content ?>
    </section>
</div>
