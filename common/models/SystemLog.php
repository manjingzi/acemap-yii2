<?php

namespace common\models;

use Yii;
use common\extensions\Util;

/**
 * This is the model class for table "{{%system_log}}".
 *
 * @property string $id ID
 * @property string $username 用户名
 * @property string $data 日志内容
 * @property string $user_id 用户ID
 * @property int $login_ip 最后登录IP
 * @property string $created_at 创建时间
 */
class SystemLog extends BaseModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%system_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['data'], 'string'],
            [['user_id', 'login_ip', 'created_at'], 'integer'],
            [['username'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'data' => Yii::t('app', 'Data'),
            'user_id' => Yii::t('app', 'User ID'),
            'login_ip' => Yii::t('app', 'Login Ip'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public static function add($data, $username = null) {
        $model = new SystemLog();
        $model->data = $data;
        $model->created_at = time();
        $model->user_id = (int) Yii::$app->user->id;
        $model->username = $username ?: (isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : '');
        $model->login_ip = Util::itoa(Yii::$app->getRequest()->getUserIP());
        return $model->save();
    }

}
