<?php

namespace common\models;

use Yii;
use common\extensions\Util;

/**
 * This is the model class for table "{{%admin_login_log}}".
 *
 * @property string $id 自增ID
 * @property string $login_name 登录名
 * @property string $login_password 登录密码
 * @property int $status 登录状态 1成功 2失败
 * @property string $login_ip 最后登录IP
 * @property string $created_at 创建时间
 */
class AdminLoginLog extends BaseModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%admin_login_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['status', 'login_ip', 'created_at'], 'integer'],
            [['login_name', 'login_password'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'login_name' => Yii::t('app/admin', 'Login Name'),
            'login_password' => Yii::t('app/admin', 'Login Password'),
            'status' => Yii::t('app/admin', 'Status'),
            'login_ip' => Yii::t('app/admin', 'Login Ip'),
            'created_at' => Yii::t('app/admin', 'Created At'),
        ];
    }

    public static function add($data) {
        $model = new AdminLoginLog();
        $model->attributes = $data;
        $model->created_at = time();
        $model->login_ip = Util::itoa(Yii::$app->getRequest()->getUserIP());
        return $model->save();
    }

}
