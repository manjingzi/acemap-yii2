<?php

namespace backend\modules\rbac\controllers;

use yii\rbac\Item;

class RoleController extends ItemController {

    public function labels() {
        return[
            'Item' => 'Role',
            'Items' => 'Roles',
        ];
    }

    public function getType() {
        return Item::TYPE_ROLE;
    }

}
