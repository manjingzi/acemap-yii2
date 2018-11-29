<?php

namespace common\models;

use Yii;
use common\extensions\Util;

/**
 * This is the model class for table "{{%user_login_log}}".
 *
 * @property string $id 自增ID
 * @property string $username 登录名
 * @property string $password 登录密码
 * @property int $status 登录状态 1成功 2失败
 * @property string $login_ip 最后登录IP
 * @property string $created_at 创建时间
 */
class UserLoginLog extends BaseModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%user_login_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['status', 'login_ip', 'created_at'], 'integer'],
            [['username', 'password'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Login Name'),
            'password' => Yii::t('app', 'Login Password'),
            'status' => Yii::t('app', 'Status'),
            'login_ip' => Yii::t('app', 'Login Ip'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public static function add($data) {
        $model = new UserLoginLog();
        $model->attributes = $data;
        $model->created_at = time();
        $model->login_ip = Util::itoa(Yii::$app->getRequest()->getUserIP());
        return $model->save();
    }

}
