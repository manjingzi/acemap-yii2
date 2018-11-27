<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\Admin;
use common\models\AdminLoginLog;
use common\models\SystemLog;

class LoginForm extends Model {

    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;

    public function rules() {
        return [
            [['username', 'password'], 'required'],
            [['username'], 'string', 'length' => [2, 20]],
            [['password'], 'string', 'length' => [6, 20]],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'rememberMe' => Yii::t('app', 'Remember me'),
        ];
    }

    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $data['status'] = Admin::STATUS_DELETED;
            $data['login_name'] = $this->username;
            $data['login_password'] = $this->password;
            $user = $this->getUser();

            if ($user) {
                if ($user->status == Admin::STATUS_DELETED) {
                    $this->addError($attribute, Yii::t('app', 'The account is locked. Please contact the administrator'));
                }
                if ($user->validatePassword($this->password)) {
                    $user->updated_at = time();
                    $user->save(false);
                    $data['status'] = Admin::STATUS_ACTIVE;
                    $data['login_password'] = '';
                } else {
                    $this->lockUser(); //判断是否锁定用户登录状态
                    $this->addError($attribute, Yii::t('app', 'Username or password is incorrect'));
                }
            } else {
                $this->addError($attribute, Yii::t('app', 'Username or password is incorrect'));
            }

            AdminLoginLog::add($data);
        }
    }

    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = Admin::existUsername($this->username);
        }

        return $this->_user;
    }

    private function lockUser() {
        $cache_name = 'admin_login_' . $this->username;
        $count = (int) Admin::getCache($cache_name);
        if ($count >= Yii::$app->params['admin_login_max_count']) {
            SystemLog::add($this->username . ' locked', $this->username); //加入系统日志
            $model = $this->getUser();
            $model->status = Admin::STATUS_DELETED;
            if ($model->save(false)) {
                Admin::delCache($cache_name);
            }
        } else {
            Admin::setCache($cache_name, $count + 1);
        }
    }

}
