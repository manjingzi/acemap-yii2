<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use yii\rbac\Role;

class AuthItemUpdateForm extends Model {

    public $name;
    public $description;
    public $rule_name;

    public function rules() {
        return [
            [['rule_name'], 'string', 'max' => 64],
            [['rule_name', 'description'], 'trim'],
            [['description'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app/rbac', 'Rule Name'),
            'data' => Yii::t('app/rbac', 'Data'),
        ];
    }

    public function updateAuthItem() {
        if (Yii::$app->request->isPost) {
            $auth = Yii::$app->authManager;
            $obj = new Role();
            $obj->name = $this->name;
            $obj->description = $this->description;
            if ($this->rule_name) {
                if (class_exists('common\rules\\' . $this->rule_name)) {
                    $obj->ruleName = $this->rule_name;
                } else {
                    throw new NotFoundHttpException(Yii::t('app/error', 'The rule class does not exist.'));
                }
            }

            return $auth->update($this->name, $obj);
        }

        return false;
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

}
