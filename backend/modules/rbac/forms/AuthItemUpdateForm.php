<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\AuthItem;

class AuthItemUpdateForm extends AuthItem {

    public $name;
    public $description;
    public $rule_name;

    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'length' => [1, 64]]
        ];
    }

    public function updateAuthItem() {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            $obj = (object) [];
            $obj->rule_name = $this->rule_name;
            $obj->description = $this->description;
            return $auth->update($this->name, $obj);
        }

        return false;
    }

    public static function findRoleModel($id) {
        $auth = Yii::$app->authManager;
        $model = $auth->getRole($id);

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function findPermissionModel($id) {
        $auth = Yii::$app->authManager;
        $model = $auth->getPermission($id);

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
