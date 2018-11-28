<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\Admin;
use backend\controllers\BaseController;
use backend\modules\user\search\AdminSearch;
use backend\modules\user\forms\AdminChangePasswordForm;
use backend\modules\user\forms\AdminCreateForm;
use backend\modules\user\forms\AdminUpdateForm;

class AdminController extends BaseController {

    public function actionIndex() {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new AdminCreateForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->createAdmin()) {
                $this->setSuccess();
                return $this->refresh();
            } else {
                $this->setError($model);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $this->checkSuperUser($id);
        $model = AdminUpdateForm::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->updateAdmin()) {
                $this->setSuccess();
                return $this->refresh();
            } else {
                $this->setError($model);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionChangePassword($id) {
        $this->checkSuperUser($id);
        $model = AdminChangePasswordForm::findOne($id);

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
        $this->checkSuperUser($id);

        if (Yii::$app->request->isPost) {
            $this->commonUpdateByField(Admin::className(), ['id' => $id], ['status' => Admin::STATUS_DELETED, 'updated_at' => time()]);
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    protected function findModel($id) {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function checkSuperUser($id) {
        if (Admin::checkSuperUser($id)) {
            $this->setError(null, Yii::t('app', 'Permission denied'));
            return $this->goHome();
        }
    }

}
