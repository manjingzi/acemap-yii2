<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\extensions\Btn;
use backend\widgets\ActiveForm;
use backend\widgets\JsBlock;

$title = Yii::t('app/rbac', 'Routes');
$label = Yii::t('app', 'View');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $label ?></h3>
    </div>
    <?php ActiveForm::begin(['action' => Url::to(['create'])]); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <textarea name="routes" rows="5" class="form-control" placeholder="<?= Yii::t('app/rbac', 'Please enter one or more routes, one per line') ?>"></textarea>
            </div>
        </div>
    </div>
    <div class="box-footer text-right">
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <?= Btn::createSubmitButton() ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
<div class="box box-primary">
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th><?= Yii::t('app/rbac', 'Route') ?></th>
                    <th><?= Yii::t('app', 'Operation') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $routes = Yii::$app->authManager->getPermissions();
                foreach ($routes as $route) {
                    if ($route->name[0] === '/') {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $route->name ?></td>
                            <td style="width:50px;"><input type="checkbox" class="checkbox checkbox_select" value="<?= $route->name ?>"></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer text-right">
        <?= Html::button(Yii::t('app', 'All select'), ['id' => 'btn-check-all', 'class' => 'btn btn-default']) ?> 
        <?= Html::button(Yii::t('app', 'Reverse select'), ['id' => 'btn-check-reverse', 'class' => 'btn btn-default']) ?> 
        <?=
        Html::button(Yii::t('app', '<i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i> ' . Yii::t('app', 'Delete')), [
            'id' => 'btn-check-delete',
            'class' => 'btn btn-danger',
            'data-url' => Url::to(['delete'])
        ])
        ?>
    </div>
</div>
<?php JsBlock::begin() ?>
<script>
    $(function () {
        $('i.glyphicon-refresh-animate').hide();
        function checkboxSelect(type) {
            if (type === 'all') {
                $('.checkbox_select').each(function (k) {
                    $(this).prop('checked', true);
                });
            } else if (type === 'reverse') {
                $('.checkbox_select').each(function (k) {
                    if ($(this).is(':checked')) {
                        $(this).prop('checked', false);
                    } else {
                        $(this).prop('checked', true);
                    }
                });
            }
        }

        function getCheckBoxValue() {
            var list = [];
            $('.checkbox_select').each(function (k) {
                if ($(this).is(':checked')) {
                    list.push($(this).val());
                }
            });
            return list;
        }

        $('#btn-check-all').click(function () {
            checkboxSelect('all');
        });

        $('#btn-check-reverse').click(function () {
            checkboxSelect('reverse');
        });

        $('#btn-check-delete').click(function () {
            var routes = getCheckBoxValue();
            if (routes.length > 0) {
                var url = $(this).data('url');
                $(this).children('i.glyphicon-refresh-animate').show();
                $.post(url, {routes: routes}, function (r) {
                    window.location.reload();
                }).always(function () {
                    $(this).children('i.glyphicon-refresh-animate').hide();
                });
            }
        });
    });
</script>
<?php JsBlock::end(); ?>