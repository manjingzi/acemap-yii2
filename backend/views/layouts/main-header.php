<?php

use yii\helpers\Url;
use backend\assets\AppAsset;

$bundle = AppAsset::register($this);
?>
<header class="main-header">
    <a href="<?= Url::to(['site/index']); ?>" class="logo">
        <span class="logo-mini">Ace</span>
        <span class="logo-lg"><b><?= Yii::$app->params['site_name_' . Yii::$app->session->get('lang')] ?></b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if (isset(Yii::$app->params['site_url']) && Yii::$app->params['site_url']) { ?>
                    <li><a href="<?= Yii::$app->params['site_url'] ?>" target="_blank"><i class="fa fa-home"></i> <?= Yii::t('app', 'Back') ?></a></li>
                <?php } ?>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $bundle->baseUrl ?>/static/img/avatar1.png" class="user-image">
                        <span class="hidden-xs"><?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : Yii::t('app', 'Guest'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?= $bundle->baseUrl ?>/static/img/avatar1.png" class="img-circle">
                            <p>
                                <?= Yii::$app->user->identity->username ?>
                                <small><?= Yii::$app->user->identity->email ?></small>
                            </p>
                        </li>
                        <li class="user-body">
                            <a href="<?= Url::to(['/site/my-password']) ?>" class="btn btn-default btn-block btn-flat"><i class="fa fa-lock"></i> <?= Yii::t('app', 'Change password') ?></a>
                            <a href="<?= Url::to(['/site/clear-cache']); ?>" class="btn btn-default btn-block btn-flat"><i class="fa fa-trash"></i> <?= Yii::t('app', 'Clear cache') ?></a>
                            <a href="<?= Url::to(['/site/logout']) ?>" class="btn btn-default btn-block btn-flat" data-method="post"><i class="fa fa-power-off"></i> <?= Yii::t('app', 'Sign out') ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>