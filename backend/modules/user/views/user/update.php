<?php
$labels = $this->context->labels();
$title = Yii::t('app/rbac', $labels['Items']);
$label = Yii::t('app', 'Update');
$this->title = $title . ' - ' . $label;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $label;
echo $this->render('_form', ['model' => $model, 'label' => $label]);
