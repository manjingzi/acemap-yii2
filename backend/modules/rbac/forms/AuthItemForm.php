<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\Model;

class AuthitemForm extends Model {

    public $name;
    public $description;
    public $rule_name;

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

    public function validateRuleName($attribute) {
        if (!$this->hasErrors()) {
            if (!$this->isExistRuleName($this->rule_name)) {
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

    public function isExistRuleName($ruleName) {
        return class_exists('common\rules\\' . $ruleName);
    }

    public function checkRuleName($ruleName) {
        if ($this->isExistRuleName($ruleName)) {
            throw new NotFoundHttpException(Yii::t('app/error', 'The rule class does not exist.'));
        }
    }

}
