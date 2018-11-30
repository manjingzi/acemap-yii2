<?php

namespace backend\modules\rbac\controllers;

use backend\controllers\BackendBaseController;

class MenuController extends BackendBaseController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreate() {
        return $this->render('create');
    }

}
