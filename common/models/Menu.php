<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property int $id
 * @property int $parent
 * @property int $order
 * @property string $name
 * @property string $route
 * @property string $data
 *
 * @property Menu $parent0
 * @property Menu[] $menus
 */
class Menu extends BaseModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['parent', 'order'], 'integer'],
            [['name'], 'required'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 256],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app/rbac', 'ID'),
            'parent' => Yii::t('app/rbac', 'Parent'),
            'order' => Yii::t('app/rbac', 'Order'),
            'name' => Yii::t('app/rbac', 'Name'),
            'route' => Yii::t('app/rbac', 'Route'),
            'data' => Yii::t('app/rbac', 'Data'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0() {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus() {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }

}
