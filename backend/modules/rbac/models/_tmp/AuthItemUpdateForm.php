<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\rbac\Role;
use yii\rbac\Permission;

class AuthItemUpdateForm extends AuthitemForm {

    public function rules() {
        return [
            [['rule_name', 'description'], 'trim'],
            [['rule_name', 'old_rule_name'], 'string', 'max' => 64],
            ['rule_name', 'validateRuleClass', 'skipOnEmpty' => true],
            [['description'], 'string', 'max' => 100],
        ];
    }

    public function validateRuleClass($attribute) {
        parent::validateRuleClass($attribute);
        if (empty($this->old_rule_name) && $this->rule_name) {
            $auth = Yii::$app->authManager;
            if ($auth->getRule($this->rule_name)) {
                $this->addError($attribute, Yii::t('app/rbac', 'The rule class already exists.'));
            }
        }
    }

    private function _update($type) {
        if ($this->validate()) {
            //模型中事务编写
            return Yii::$app->db->transaction(function() use($type) {
                        if (Role::TYPE_ROLE == $type) {
                            $obj = new Role();
                        } else {
                            $obj = new Permission();
                        }
                        $auth = Yii::$app->authManager;
                        if ($this->old_rule_name) {
                            //本次规则为空或和原规则不一致就删除
                            if ($this->rule_name != $this->old_rule_name) {
                                $rule = new $this->old_rule_name;
                                $auth->remove($rule);
                            } else {
                                //原规则没有修改只要保存数据即可
                                $obj->ruleName = $this->rule_name;
                            }
                        } else {
                            //如果原本没有规则，本次新增了，需要新增规则
                            if ($this->rule_name) {
                                $rule = new $this->rule_name;
                                $auth->add($rule);
                                $obj->ruleName = $this->rule_name;
                            }
                        }

                        $obj->name = $this->name;
                        $obj->description = $this->description;

                        return $auth->update($this->name, $obj);
                    });
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
