<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\forms\LoginForm;

class SiteController extends BaseController {

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
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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

        $this->goBack(Yii::$app->request->referrer); //切换完语言哪来的返回到哪里
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

}
