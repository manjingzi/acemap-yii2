<?php

namespace backend\modules\rbac\controllers;

use Yii;
use common\models\AuthItem;
use backend\controllers\BaseController;
use backend\modules\rbac\search\AuthItemSearch;
use backend\modules\rbac\forms\AuthItemCreateForm;
use backend\modules\rbac\forms\AuthItemUpdateForm;

class RoleController extends BaseController {

    public function actionIndex() {
        $searchModel = new AuthItemSearch(['type' => 1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new AuthItemCreateForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->createRole()) {
                $this->setSuccess();
                return $this->refresh();
            } else {
                $this->setError($model);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id) {
        $model = AuthItemUpdateForm::findRoleModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = AuthItemUpdateForm::findRoleModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->updateAuthItem()) {
                $this->setSuccess();
                return $this->refresh();
            } else {
                $this->setError($model);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

}
