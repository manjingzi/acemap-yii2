<?php

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authority control'), 'url' => ['index']];
echo $this->render('_form');
