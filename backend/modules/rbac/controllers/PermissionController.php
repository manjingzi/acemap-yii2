<?php

namespace backend\modules\rbac\controllers;

use yii\rbac\Item;

class PermissionController extends ItemController {

    public function labels() {
        return[
            'Items' => 'Permissions',
        ];
    }

    public function getType() {
        return Item::TYPE_PERMISSION;
    }

}
