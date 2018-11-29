<?php

namespace backend\modules\rbac\forms;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class AuthItemCreateForm extends Model {

    public $name;
    public $description;
    public $rule_name;

    public function rules() {
        return [
            [['name'], 'required'],
            [['name', 'rule_name', 'description'], 'trim'],
            [['name', 'rule_name'], 'string', 'max' => 64],
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

    public function createRole() {
        if (Yii::$app->request->isPost) {
            $auth = Yii::$app->authManager;
            $obj = $auth->createRole($this->name);
            $obj->description = $this->description;

            if ($this->rule_name) {
                if (class_exists('common\rules\\' . $this->rule_name)) {
                    $obj->ruleName = $this->rule_name;
                } else {
                    throw new NotFoundHttpException(Yii::t('app/error', 'The rule class does not exist.'));
                }
            }

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
