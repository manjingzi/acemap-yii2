<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\Admin;
use backend\controllers\BaseController;
use backend\modules\user\forms\AdminSearch;
use backend\forms\AdminChangePasswordForm;

class AdminController extends BaseController {

    public function actionIndex() {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new Admin();
        if (Yii::$app->request->isPost) {
            if ($this->commonCreate($model)) {
                return $this->refresh();
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($this->commonUpdate($model)) {
                return $this->refresh();
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionChangePassword($id) {
        $model = new AdminChangePasswordForm($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->changePassword()) {
                $this->setSuccess();
                return $this->refresh();
            } else {
                $this->setError($model);
            }
        }

        return $this->render('change-password', ['model' => $model]);
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            if ($this->commonUpdateField(User::className(), ['c_status' => User::STATUS_NO], ['c_id' => $id])) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    protected function findModel($id) {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
