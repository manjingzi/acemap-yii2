<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\controllers\BaseController;
use backend\modules\user\forms\AdminSearch;

class AdminController extends BaseController {

    public function actionIndex() {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
