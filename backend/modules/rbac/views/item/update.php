<?php

$this->title = Yii::t('app', 'Update');
$labels = $this->context->labels();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/rbac', $labels['Items']), 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
