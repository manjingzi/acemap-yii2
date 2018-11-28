<?php

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Roles'), 'url' => ['index']];
echo $this->render('_form');
