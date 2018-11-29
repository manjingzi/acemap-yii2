<?php

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System user'), 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
