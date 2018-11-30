<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\extensions\Util;
use common\forms\LoginForm;
use common\forms\ChangePasswordForm;

class SiteController extends BackendBaseController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'lang', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'logout', 'clear-cache','change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLang() {
        $lang = Yii::$app->request->get('lang');

        if ($lang && in_array($lang, Yii::$app->params['site_lang'])) {
            Yii::$app->session->set('lang', $lang);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            $this->layout = 'login';
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionChangePassword() {
        $model = new ChangePasswordForm();
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

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $this->layout = 'error';
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionClearCache() {
        Yii::$app->cache->flush(); //数据缓存文件

        $backend_runtime_dir = Yii::getAlias('@backend/runtime');
        $backend_runtime_array = Util::getDir($backend_runtime_dir);

        foreach ($backend_runtime_array as $dir) {
            Util::deleteDirAndFile($backend_runtime_dir . DIRECTORY_SEPARATOR . $dir);
        }

        $backend_dir = Yii::getAlias('@backend/web/assets');
        $backend_array = Util::getDir($backend_dir);

        foreach ($backend_array as $dir) {
            Util::deleteDirAndFile($backend_dir . DIRECTORY_SEPARATOR . $dir);
        }

        $frontend_runtime_dir = Yii::getAlias('@frontend/runtime');
        $frontend_runtime_array = Util::getDir($frontend_runtime_dir);

        foreach ($frontend_runtime_array as $dir) {
            Util::deleteDirAndFile($frontend_runtime_dir . DIRECTORY_SEPARATOR . $dir);
        }

        $frontend_dir = Yii::getAlias('@frontend/web/assets');
        $frontend_array = Util::getDir($frontend_dir);

        foreach ($frontend_array as $dir) {
            Util::deleteDirAndFile($frontend_dir . DIRECTORY_SEPARATOR . $dir);
        }

        $this->setSuccess();
        return $this->redirect(Yii::$app->request->referrer);
    }

}
