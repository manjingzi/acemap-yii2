<?php

$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', 'Permissions'), 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
