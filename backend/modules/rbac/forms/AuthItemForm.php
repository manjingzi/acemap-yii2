<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\Model;

class AuthitemForm extends Model {

    public $name;
    public $description;
    public $rule_name;
    public $old_rule_name;

    public function attributeLabels() {
        return [
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app/rbac', 'Rule Name'),
            'data' => Yii::t('app/rbac', 'Data'),
        ];
    }

    public function validateName($attribute) {
        if (!$this->hasErrors()) {
            $auth = Yii::$app->authManager;
            $model = $auth->getRole($this->name);
            if ($model) {
                $this->addError($attribute, Yii::t('yii', '{attribute} "{value}" has already been taken.', ['attribute' => Yii::t('app', 'Name')]));
            }
        }
    }

    public function validateRuleClass($attribute) {
        if (!$this->hasErrors()) {
            //检测是否合法
            if (!$this->isExistRuleClass($this->rule_name)) {
                $this->addError($attribute, Yii::t('app/error', 'The rule class does not exist.'));
            }
        }
    }

    public function getChildRoles() {
        $auth = Yii::$app->authManager;
        return $auth->getChildRoles($this->name);
    }

    public function findRoleModel() {
        $auth = Yii::$app->authManager;
        $model = $auth->getRole($this->name);

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app/error', 'The requested page does not exist.'));
        }
    }

    public function findPermissionModel() {
        $auth = Yii::$app->authManager;
        $model = $auth->getPermission($this->name);

        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app/error', 'The requested page does not exist.'));
        }
    }

    public function isExistRuleClass($ruleName) {
        return class_exists($ruleName);
    }

    public function checkRuleClass($ruleName) {
        if (!$this->isExistRuleClass($ruleName)) {
            throw new NotFoundHttpException(Yii::t('app/error', 'The rule class does not exist.'));
        }
    }

}
