<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\controllers\BackendBaseController;

class AssignmentController extends BackendBaseController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreate() {
        return $this->render('create');
    }

}
