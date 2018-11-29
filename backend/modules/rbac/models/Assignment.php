<?php

namespace backend\modules\rbac\models;

use Yii;
use Exception;

class Assignment extends \yii\base\BaseObject {

    public $id;
    public $user;

    public function __construct($id, $user = null, $config = array()) {
        $this->id = $id;
        $this->user = $user;
        parent::__construct($config);
    }

    public function assign($items) {
        $auth = Yii::$app->authManager;
        $success = 0;
        foreach ($items as $name) {
            try {
                $obj = $auth->getRole($name);
                $item = $obj ?: $auth->getPermission($name);
                $auth->assign($item, $this->id);
                $success++;
            } catch (Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        //Helper::invalidate();
        return $success;
    }

    public function revoke($items) {
        $auth = Yii::$app->authManager;
        $success = 0;
        foreach ($items as $name) {
            try {
                $obj = $auth->getRole($name);
                $item = $obj ?: $auth->getPermission($name);
                $auth->revoke($item, $this->id);
                $success++;
            } catch (Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        //Helper::invalidate();
        return $success;
    }

    public function getItems() {
        $auth = Yii::$app->authManager;
        $available = [];
        foreach (array_keys($auth->getRoles()) as $name) {
            $available[$name] = 'role';
        }

        foreach (array_keys($auth->getPermissions()) as $name) {
            if ($name[0] != '/') {
                $available[$name] = 'permission';
            }
        }

        $assigned = [];
        foreach ($auth->getAssignments($this->id) as $item) {
            $assigned[$item->roleName] = $available[$item->roleName];
            unset($available[$item->roleName]);
        }

        return [
            'available' => $available,
            'assigned' => $assigned,
        ];
    }

    public function __get($name) {
        if ($this->user) {
            return $this->user->$name;
        }
    }

}
