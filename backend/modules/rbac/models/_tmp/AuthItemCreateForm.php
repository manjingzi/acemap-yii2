<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\rbac\Item;

class AuthItemCreateForm extends AuthItemForm {

    public function rules() {
        return [
            [['rule_name', 'description'], 'trim'],
            [['name'], 'required'],
            ['name', 'validateName'],
            [['rule_name'], 'string', 'max' => 64],
            ['rule_name', 'validateRuleClass', 'skipOnEmpty' => true],
            [['description'], 'string', 'max' => 100],
        ];
    }

    private function _create($type) {
        if ($this->validate()) {
            //模型中事务编写
            return Yii::$app->db->transaction(function() use ($type) {
                        $auth = Yii::$app->authManager;
                        if (Item::TYPE_ROLE == $type) {
                            $obj = $auth->createRole($this->name);
                        } else {
                            $obj = $auth->createPermission($this->name);
                        }
                        if ($this->rule_name) {
                            $obj->ruleName = $this->rule_name;
                            $rule = new $this->rule_name;
                            $auth->add($rule);
                        }

                        $obj->description = $this->description;

                        return $auth->add($obj);
                    });
        }

        return false;
    }

    public function createRole() {
        return $this->_create(Item::TYPE_ROLE);
    }

    public function createPermission() {
        return $this->_create(Item::TYPE_PERMISSION);
    }

}
