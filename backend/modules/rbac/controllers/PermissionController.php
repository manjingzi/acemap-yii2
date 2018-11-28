<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\controllers\BaseController;
use backend\modules\rbac\search\AuthItemSearch;
use backend\modules\rbac\forms\AuthItemCreateForm;

class PermissionController extends BaseController {

    public function actionIndex() {
        $searchModel = new AuthItemSearch(['type' => 2]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new AuthItemCreateForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->createPermission()) {
                $this->setSuccess();
                return $this->refresh();
            } else {
                $this->setError($model);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    protected function findModel($id) {
        $auth = Yii::$app->authManager;
        $model = $auth->getPermission($id);

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
