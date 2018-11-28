<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%auth_rule}}".
 *
 * @property string $name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AuthItem[] $authItems
 */
class AuthRule extends BaseModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%auth_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('app/rbac', 'Name'),
            'data' => Yii::t('app/rbac', 'Data'),
            'created_at' => Yii::t('app/rbac', 'Created At'),
            'updated_at' => Yii::t('app/rbac', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems() {
        return $this->hasMany(AuthItem::className(), ['rule_name' => 'name']);
    }

}
