<?php

use backend\widgets\JsBlock;
?>
<?php if (Yii::$app->getSession()->hasFlash('success') || Yii::$app->getSession()->hasFlash('error')) { ?>
    <?php JsBlock::begin() ?>
    <script>
        $(function () {
            $('.alert-dismissible').fadeOut(3000, function () {
                $(this).alert('close');
            });
        });
    </script>
    <?php JsBlock::end() ?>
<?php } ?>
<?php if (Yii::$app->getSession()->hasFlash('success')) { ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check-circle"></i> <?= Yii::$app->getSession()->getFlash('success') ?>
    </div>
<?php } ?>
<?php if (Yii::$app->getSession()->hasFlash('error')) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-times-circle"></i> <?= Yii::$app->getSession()->getFlash('error') ?>
    </div>
<?php } ?>