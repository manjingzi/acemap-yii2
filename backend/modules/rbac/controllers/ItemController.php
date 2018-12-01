<?php

namespace backend\modules\rbac\controllers;

use Yii;
use yii\rbac\Item;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use backend\controllers\BackendBaseController;
use backend\modules\rbac\models\AuthItem;
use backend\modules\rbac\search\AuthItemSearch;

class ItemController extends BackendBaseController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'assign' => ['post'],
                    'remove' => ['post'],
                ],
            ],
        ];
    }

    public function getViewPath() {
        return $this->module->getViewPath() . DIRECTORY_SEPARATOR . 'item';
    }

    public function actionIndex() {
        $searchModel = new AuthItemSearch(['type' => $this->type]);
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate() {
        $model = new AuthItem(null);
        $model->type = $this->type;
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id) {
        $model = $this->findModel($id);
        Yii::$app->authManager->remove($model->item);

        return $this->redirect(['index']);
    }

    public function actionAssign($id) {
        $items = Yii::$app->getRequest()->post('items', []);
        $model = $this->findModel($id);
        $success = $model->addChildren($items);
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;

        return array_merge($model->getItems(), ['success' => $success]);
    }

    public function actionRemove($id) {
        $items = Yii::$app->getRequest()->post('items', []);
        $model = $this->findModel($id);
        $success = $model->removeChildren($items);
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;

        return array_merge($model->getItems(), ['success' => $success]);
    }

    protected function findModel($id) {
        $auth = Yii::$app->authManager;
        $item = $this->type === Item::TYPE_ROLE ? $auth->getRole($id) : $auth->getPermission($id);
        if ($item) {
            return new AuthItem($item);
        } else {
            throw new NotFoundHttpException(Yii::t('app/error', 'The requested page does not exist'));
        }
    }

}
