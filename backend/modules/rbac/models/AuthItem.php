<?php

namespace backend\modules\rbac\models;

use Exception;
use Yii;
use yii\base\Model;
use yii\helpers\Json;
use yii\rbac\Item;

class AuthItem extends Model {

    public $name;
    public $type;
    public $description;
    public $ruleName;
    public $data;
    private $_item;

    public function __construct($item = null, $config = []) {
        $this->_item = $item;
        if ($item !== null) {
            $this->name = $item->name;
            $this->type = $item->type;
            $this->description = $item->description;
            $this->ruleName = $item->ruleName;
            $this->data = $item->data === null ? null : Json::encode($item->data);
        }
        parent::__construct($config);
    }

    public function rules() {
        return [
            [['ruleName'], 'checkRule'],
            [['name', 'type'], 'required'],
            [['name'], 'checkUnique', 'when' => function () {
                    return $this->isNewRecord || ($this->_item->name != $this->name);
                }],
            [['type'], 'integer'],
            [['description', 'data', 'ruleName'], 'default'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    public function checkUnique() {
        $auth = Yii::$app->authManager;
        $value = $this->name;
        if ($auth->getRole($value) !== null || $auth->getPermission($value) !== null) {
            $message = Yii::t('yii', '{attribute} "{value}" has already been taken.');
            $params = [
                'attribute' => $this->getAttributeLabel('name'),
                'value' => $value,
            ];
            $this->addError('name', Yii::$app->getI18n()->format($message, $params, Yii::$app->language));
        }
    }

    public function checkRule() {
        $name = $this->ruleName;
        if (!Yii::$app->authManager->getRule($name)) {
            try {
                $rule = Yii::createObject($name);
                if ($rule instanceof \yii\rbac\Rule) {
                    $rule->name = $name;
                    Yii::$app->authManager->add($rule);
                } else {
                    $this->addError('ruleName', Yii::t('app/rbac', 'Invalid rule'));
                }
            } catch (Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
                $this->addError('ruleName', Yii::t('app/rbac', 'The rule class does not exist'));
            }
        }
    }

    public function attributeLabels() {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'ruleName' => Yii::t('app/rbac', 'Rule Name'),
            'data' => Yii::t('app/rbac', 'Data'),
        ];
    }

    public function getIsNewRecord() {
        return $this->_item === null;
    }

    public static function find($id) {
        $item = Yii::$app->authManager->getRole($id);
        if ($item !== null) {
            return new self($item);
        }

        return null;
    }

    public function save() {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            if ($this->_item === null) {
                if ($this->type == Item::TYPE_ROLE) {
                    $this->_item = $auth->createRole($this->name);
                } else {
                    $this->_item = $auth->createPermission($this->name);
                }
                $isNew = true;
            } else {
                $isNew = false;
                $oldName = $this->_item->name;
            }
            $this->_item->name = $this->name;
            $this->_item->description = $this->description;
            $this->_item->ruleName = $this->ruleName;
            $this->_item->data = $this->data === null || $this->data === '' ? null : Json::decode($this->data);
            if ($isNew) {
                $auth->add($this->_item);
            } else {
                $auth->update($oldName, $this->_item);
            }
            //Helper::invalidate();
            return true;
        } else {
            return false;
        }
    }

    public function addChildren($items) {
        $auth = Yii::$app->authManager;
        $success = 0;
        if ($this->_item) {
            foreach ($items as $name) {
                $child = $auth->getPermission($name);
                if ($this->type == Item::TYPE_ROLE && $child === null) {
                    $child = $auth->getRole($name);
                }
                try {
                    $auth->addChild($this->_item, $child);
                    $success++;
                } catch (Exception $exc) {
                    Yii::error($exc->getMessage(), __METHOD__);
                }
            }
        }
        if ($success > 0) {
            //Helper::invalidate();
        }
        return $success;
    }

    public function removeChildren($items) {
        $auth = Yii::$app->authManager;
        $success = 0;
        if ($this->_item !== null) {
            foreach ($items as $name) {
                $child = $auth->getPermission($name);
                if ($this->type == Item::TYPE_ROLE && $child === null) {
                    $child = $auth->getRole($name);
                }
                try {
                    $auth->removeChild($this->_item, $child);
                    $success++;
                } catch (Exception $exc) {
                    Yii::error($exc->getMessage(), __METHOD__);
                }
            }
        }
        if ($success > 0) {
            //Helper::invalidate();
        }
        return $success;
    }

    public function getItems() {
        $auth = Yii::$app->authManager;
        $available = [];
        if ($this->type == Item::TYPE_ROLE) {
            foreach (array_keys($auth->getRoles()) as $name) {
                $available[$name] = 'role';
            }
        }
        foreach (array_keys($auth->getPermissions()) as $name) {
            $available[$name] = $name[0] == '/' ? 'route' : 'permission';
        }

        $assigned = [];
        foreach ($auth->getChildren($this->_item->name) as $item) {
            $assigned[$item->name] = $item->type == 1 ? 'role' : ($item->name[0] == '/' ? 'route' : 'permission');
            unset($available[$item->name]);
        }
        unset($available[$this->name]);
        return [
            'available' => $available,
            'assigned' => $assigned,
        ];
    }

    public function getItem() {
        return $this->_item;
    }

    public static function getTypeName($type = null) {
        $result = [
            Item::TYPE_PERMISSION => 'Permission',
            Item::TYPE_ROLE => 'Role',
        ];
        if ($type === null) {
            return $result;
        }

        return $result[$type];
    }

}
