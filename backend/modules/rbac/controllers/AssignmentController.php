<?php

namespace backend\modules\rbac\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use common\models\User;
use backend\controllers\BackendBaseController;
use backend\modules\rbac\models\Assignment;

class AssignmentController extends BackendBaseController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'assign' => ['post'],
                    'revoke' => ['post'],
                ],
            ],
        ];
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionAssign($id) {
        $items = Yii::$app->getRequest()->post('items', []);
        $model = new Assignment($id);
        $success = $model->assign($items);
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;

        return array_merge($model->getItems(), ['success' => $success]);
    }

    public function actionRevoke($id) {
        $items = Yii::$app->getRequest()->post('items', []);
        $model = new Assignment($id);
        $success = $model->revoke($items);
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;

        return array_merge($model->getItems(), ['success' => $success]);
    }

    protected function findModel($id) {
        $user = User::findIdentity($id);
        if ($user) {
            return new Assignment($id, $user);
        } else {
            throw new NotFoundHttpException(Yii::t('app/error', 'The requested page does not exist'));
        }
    }

}
