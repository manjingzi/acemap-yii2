<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%admin_operation_log}}".
 *
 * @property string $id ID
 * @property string $username 用户名
 * @property string $route 路由地址
 * @property string $data_before 更新或删除之前的数据
 * @property string $data_add 新增的数据
 * @property int $type 操作类型 1新增 2更新 3删除
 * @property int $status 状态 1成功 2失败
 * @property string $user_id 用户ID
 * @property string $object_id 操作的对象ID
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class AdminOperationLog extends BaseModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%admin_operation_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['data_before', 'data_add'], 'string'],
            [['type', 'status', 'user_id', 'object_id', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['route'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'route' => Yii::t('app', 'Route'),
            'data_before' => Yii::t('app', 'Data Before'),
            'data_add' => Yii::t('app', 'Data Add'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'User ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function add($data) {
        $model = new AdminOperationLog();
        $model->attributes = $data;
        $model->user_id = (int) Yii::$app->user->id;
        $model->username = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : '';
        $model->created_at = time();
        return $model->save();
    }

}
