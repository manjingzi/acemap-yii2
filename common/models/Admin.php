<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $id 自增ID
 * @property string $username 用户名
 * @property string $auth_key 自动登录key
 * @property string $password_hash 加密密码
 * @property string $password_reset_token 重置密码token
 * @property string $email 邮箱
 * @property int $status 用户状态
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class Admin extends BaseModel implements IdentityInterface {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app/admin', 'ID'),
            'username' => Yii::t('app/admin', 'Username'),
            'auth_key' => Yii::t('app/admin', 'Auth Key'),
            'password_hash' => Yii::t('app/admin', 'Password Hash'),
            'password_reset_token' => Yii::t('app/admin', 'Password Reset Token'),
            'email' => Yii::t('app/admin', 'Email'),
            'status' => Yii::t('app/admin', 'Status'),
            'created_at' => Yii::t('app/admin', 'Created At'),
            'updated_at' => Yii::t('app/admin', 'Updated At'),
        ];
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        if ($token && $type == null) {
            throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne(['password_reset_token' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['email_reset_token_expire'];
        return $timestamp + $expire >= time();
    }

}
