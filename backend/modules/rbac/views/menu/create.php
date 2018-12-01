<?php

$title = Yii::t('app/rbac', 'Menus');
$label = Yii::t('app', 'Create');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
echo $this->render('_form', ['model' => $model, 'label' => $label]);