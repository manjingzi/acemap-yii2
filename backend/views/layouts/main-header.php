<?php

use yii\helpers\Url;
use backend\assets\AppAsset;

$bundle = AppAsset::register($this);
?>
<header class="main-header">
    <a href="<?= Url::to(['site/index']); ?>" class="logo">
        <span class="logo-mini">JJ</span>
        <span class="logo-lg"><b><?= Yii::$app->params['site_name_' . Yii::$app->session->get('lang')] ?></b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if (isset(Yii::$app->params['site_url']) && Yii::$app->params['site_url']) { ?>
                    <li><a href="<?= Yii::$app->params['site_url'] ?>" target="_blank"><i class="fa fa-home"></i> <?= Yii::t('app', 'Back') ?></a></li>
                <?php } ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-language"></i>
                        <?= Yii::t('app', 'Switch language') ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        $array = Yii::$app->params['site_lang'];
                        //不显示当前语言
                        foreach ($array as $lang) {
                            if ($lang !== Yii::$app->session->get('lang')) {
                                ?>
                                <li><a href="<?= Url::to(['/site/lang', 'lang' => $lang]) ?>"> <?= Yii::t('app', $lang) ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : Yii::t('app', 'Guest'); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= Url::to(['/site/my-password']) ?>" data-method="post"><i class="fa fa-lock"></i> <?= Yii::t('app', 'Change password') ?></a></li>
                        <li><a href="<?= Url::to(['/site/clear-cache']); ?>"><i class="fa fa-trash"></i> <?= Yii::t('app', 'Clear cache') ?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?= Url::to(['/site/logout']) ?>" data-method="post"><i class="fa fa-power-off"></i> <?= Yii::t('app', 'Sign out') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>






