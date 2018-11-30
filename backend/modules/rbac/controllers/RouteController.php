<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\modules\rbac\models\Route;
use backend\controllers\BackendBaseController;

class RouteController extends BackendBaseController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreate() {
        if (Yii::$app->request->isPost) {
            $routes = Yii::$app->getRequest()->post('routes');
            if ($routes) {
                $array = explode(PHP_EOL, $routes);
                $model = new Route();
                $model->addNew($array);
            } else {
                $this->setError(null, Yii::t('app/error', 'Parameter cannot be empty'));
            }
        }

        return $this->redirect(['index']);
    }

    public function actionDelete() {
        if (Yii::$app->request->isPost) {
            $routes = Yii::$app->getRequest()->post('routes');
            if ($routes) {
                $model = new Route();
                $model->remove($routes);
            } else {
                $this->setError(null, Yii::t('app/error', 'Parameter cannot be empty'));
            }
        }
    }

}
