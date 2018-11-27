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
 * @property int $status 用户状态 1正常 2无效
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
            [['username', 'password_hash', 'email'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'length' => [2, 20]],
            [['password_hash'], 'string', 'length' => [6, 20]],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'string', 'max' => 43],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['username', 'email', 'password_reset_token'], 'unique'],
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
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'newPassword' => Yii::t('app', 'New password'),
            'confirmPassword' => Yii::t('app', 'Confirm password'),
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

    public static function existUsername($username) {
        return static::findOne(['username' => $username]);
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

    public static function checkSuperUser($id) {
        return in_array($id, Yii::$app->params['admin_super_user_id']);
    }

}
