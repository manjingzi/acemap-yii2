<?php

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'System user'), 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
