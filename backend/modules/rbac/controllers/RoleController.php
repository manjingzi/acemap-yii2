<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\controllers\BackendBaseController;
use backend\modules\rbac\forms\AuthItemCreateForm;
use backend\modules\rbac\forms\AuthItemUpdateForm;

class RoleController extends BackendBaseController {

    public function actionIndex() {
        $auth = Yii::$app->authManager;
        $rows = $auth->getRoles();
        return $this->render('index', ['rows' => $rows]);
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
        $model = new AuthItemUpdateForm(['name' => $id]);

        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = new AuthItemUpdateForm(['name' => $id]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->updateRole()) {
                $this->setSuccess();
                return $this->refresh();
            } else {
                $this->setError($model);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

}
