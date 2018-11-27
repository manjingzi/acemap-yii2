<?php

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'System user'), 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
