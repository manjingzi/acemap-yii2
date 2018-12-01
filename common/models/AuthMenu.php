<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%auth_menu}}".
 *
 * @property string $id
 * @property string $pid 父ID
 * @property string $order 排序
 * @property int $status 显示状态 1正常 2无效
 * @property string $name 菜单名称
 * @property string $route 路由
 */
class AuthMenu extends BaseModel {

    //分割字符串
    const SELECT_STRING = ' ├ ';

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%auth_menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['pid', 'order', 'status'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['route'], 'string', 'max' => 100],
            [['pid', 'order'], 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'pid' => Yii::t('app', 'Pid'),
            'order' => Yii::t('app', 'Order'),
            'status' => Yii::t('app/rbac', 'Display State'),
            'name' => Yii::t('app', 'Name'),
            'route' => Yii::t('app/rbac', 'Route'),
        ];
    }

    public function getPname() {
        return $this->hasOne(static::className(), ['id' => 'pid']);
    }

    //检查父ID是否在子类数组中
    public static function checkSub($id, $pid = 0) {
        $sub = static::getSub($id);
        return in_array($pid, $sub);
    }

    //获取所有子类ID
    public static function getSub($id) {
        static $array = [];
        $data = static::find()->where(['pid' => $id])->asArray()->all();
        if ($data) {
            foreach ($data as $v) {
                $array[] = $v['id'];
                static::getSub($v['id']);
            }
        }
        return $array;
    }

    /**
     * 格式化下拉数据
     * @param type $default
     * @param type $where
     * @param type $show_layer
     */
    public static function formatDropDownList($where = null, $layer = 2) {
        static $array = [];
        $data = static::getMenuTree($where);
        foreach ($data as $item) {
            static::dropDownList($array, $item, $layer);
        }
        return $array;
    }

    /**
     * 返回树形数组
     * @param type $where
     * @return type
     */
    protected static function getMenuTree($where = null, $orderby = ['pid' => SORT_ASC, 'order' => SORT_DESC]) {
        $model = static::find();
        $model->orderBy($orderby);
        if ($where) {
            $model->where($where);
        }
        $data = $model->asArray()->all();
        return self::getTree($data);
    }

    protected static function dropDownList(&$array, $item, $show_layer, $current_layer = 1) {
        $array[$item['id']] = str_repeat(self::SELECT_STRING, $current_layer - 1) . $item['name'];
        if (isset($item['sub']) && $current_layer < $show_layer) {
            foreach ($item['sub'] as $v) {
                static::dropDownList($array, $v, $show_layer, $current_layer + 1);
            }
        }
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //格式化路由
            if ($this->route) {
                $this->route = '/' . ltrim($this->route, '/');
            }
            if (!$insert) {
                if ($this->pid == $this->id) { //禁止选择该节点为自己的父节点
                    $this->addError('pid', Yii::t('app/error', 'It is forbidden to select this node as its own parent node'));
                    return false;
                }
                if (static::checkSub($this->id, $this->pid)) {//禁止选择该节点为自己的子节点
                    $this->addError('pid', Yii::t('app/error', 'It is forbidden to select this node as its own child node'));
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 删除之前处理相关数据
     */
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            if (static::getSub($this->id)) {//本节点还有子节点
                $this->addError('pid', Yii::t('app/error', 'This node has child nodes'));
                return false;
            }
        }
        return true;
    }

}
