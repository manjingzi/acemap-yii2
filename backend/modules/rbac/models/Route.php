<?php

namespace backend\modules\rbac\models;

use Exception;
use Yii;
use common\rules\RouteRule;
use common\models\BaseModel;

class Route extends \yii\base\BaseObject {

    const PREFIX_BASIC = '/';

    public function addNew($routes) {
        $auth = Yii::$app->authManager;

        foreach ($routes as $route) {
            try {
                $r = explode('&', $route);
                $item = $auth->createPermission($this->getPermissionName($route));
                if (count($r) > 1) {
                    $action = '/' . trim($r[0], '/');
                    if (($itemAction = $auth->getPermission($action)) === null) {
                        $itemAction = $auth->createPermission($action);
                        $auth->add($itemAction);
                    }
                    unset($r[0]);
                    foreach ($r as $part) {
                        $part = explode('=', $part);
                        $item->data['params'][$part[0]] = isset($part[1]) ? $part[1] : '';
                    }
                    $this->setDefaultRule();
                    $item->ruleName = RouteRule::RULE_NAME;
                    $auth->add($item);
                    $auth->addChild($item, $itemAction);
                } else {
                    $auth->add($item);
                }
            } catch (Exception $exc) {
                BaseModel::setError(null, $exc->getMessage());
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }

        BaseModel::setSuccess();
    }

    public function remove($routes) {
        foreach ($routes as $route) {
            try {
                $auth = Yii::$app->authManager;
                $item = $auth->createPermission($this->getPermissionName($route));
                $auth->remove($item);
            } catch (Exception $exc) {
                BaseModel::setError(null, $exc->getMessage());
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }

        BaseModel::setSuccess();
    }

    public function getPermissionName($route) {
        return self::PREFIX_BASIC . trim($route, self::PREFIX_BASIC);
    }

    protected function setDefaultRule() {
        $auth = Yii::$app->authManager;
        if ($auth->getRule(RouteRule::RULE_NAME) === null) {
            $auth->add(new RouteRule());
        }
    }

}
