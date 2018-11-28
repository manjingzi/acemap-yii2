<?php

namespace backend\modules\rbac\forms;

use Yii;
use common\models\AuthItem;

class AuthItemCreateForm extends AuthItem {

    public $name;
    public $description;
    public $rule_name;

    public function rules() {
        return [
            [['name'], 'required'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['description'], 'string'],
        ];
    }

    public function createRole() {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            $obj = $auth->createRole($this->name);
            $obj->description = $this->description;

            return $auth->add($obj);
        }

        return false;
    }

    public function createPermission() {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            $obj = $auth->createPermission($this->name);
            $obj->description = $this->description;
            return $auth->add($obj);
        }

        return false;
    }

}
