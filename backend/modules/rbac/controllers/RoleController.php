<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\controllers\BaseController;
use backend\modules\rbac\search\RoleSearch;

class RoleController extends BaseController {

    public function actionIndex() {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        return $this->render('create');
    }

}
