<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\rbac\Role;
use yii\rbac\Permission;

class AuthItemUpdateForm extends AuthitemForm {

    public function rules() {
        return [
            [['rule_name', 'description'], 'trim'],
            [['rule_name'], 'string', 'max' => 64],
            ['rule_name', 'validateRuleName', 'skipOnEmpty' => true],
            [['description'], 'string', 'max' => 100],
        ];
    }

    private function _update($type) {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            if (Role::TYPE_ROLE == $type) {
                $obj = new Role();
            } else {
                $obj = new Permission();
            }
            if ($this->rule_name) {
                $this->checkRuleName($this->rule_name);
                $obj->ruleName = $this->rule_name;
            }

            $obj->name = $this->name;
            $obj->description = $this->description;

            return $auth->update($this->name, $obj);
        }

        return false;
    }

    public function updateRole() {
        return $this->_update(Role::TYPE_ROLE);
    }

    public function updatePermission() {
        return $this->_update(Permission::TYPE_PERMISSION);
    }

}
