<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\User;
use backend\controllers\BackendBaseController;
use backend\modules\user\search\UserSearch;
use backend\modules\user\forms\UserChangePasswordForm;
use backend\modules\user\forms\UserCreateForm;
use backend\modules\user\forms\UserUpdateForm;

class UserController extends BackendBaseController {

    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new UserCreateForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->createUser()) {
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
        $model = UserUpdateForm::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->updateUser()) {
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
        $model = UserChangePasswordForm::findOne($id);

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
            $this->commonUpdateByField(User::className(), ['id' => $id], ['status' => User::STATUS_DELETED, 'updated_at' => time()]);
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app/error', 'The requested page does not exist'));
        }
    }

    protected function checkSuperUser($id) {
        if (User::checkSuperUser($id)) {
            $this->setError(null, Yii::t('app/error', 'Permission denied'));
            return $this->goHome();
        }
    }

}
