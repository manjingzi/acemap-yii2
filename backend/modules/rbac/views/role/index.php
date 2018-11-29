<?php

use yii\helpers\Url;
use backend\widgets\ActiveForm;

$this->title = Yii::t('app', 'List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Roles'), 'url' => ['index']];
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right"><?= ActiveForm::staticCreateButton() ?></div>
                <h3 class="box-title"><?= $this->title ?></h3>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?= Yii::t('app', 'Name') ?></th>
                            <th><?= Yii::t('app', 'Description') ?></th>
                            <th><?= Yii::t('app/rbac', 'Rule Name') ?></th>
                            <th><?= Yii::t('app', 'Created At') ?></th>
                            <th><?= Yii::t('app', 'Operation') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $row) {
                            ?>
                            <tr>
                                <td><?= $row->name ?></td>
                                <td><?= $row->description ?></td>
                                <td><?= $row->ruleName ?></td>
                                <td><?= date('Y-m-d H:i:s', $row->createdAt) ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="<?= Url::to(['view', 'id' => $row->name]) ?>"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-sm btn-primary" href="<?= Url::to(['update', 'id' => $row->name]) ?>"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>