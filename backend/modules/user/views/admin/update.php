<?php

$this->title = Yii::t('app/admin', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/admin', 'System user list'), 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);