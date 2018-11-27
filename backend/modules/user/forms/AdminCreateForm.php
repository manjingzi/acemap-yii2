<?php

namespace backend\modules\user\forms;

use Yii;
use common\models\Admin;

class AdminCreateForm extends Admin {

    public $username;
    public $newPassword;
    public $confirmPassword;
    public $email;
    public $status;

    public function rules() {
        return [
            [['username', 'email', 'newPassword', 'confirmPassword'], 'required'],
            [['username'], 'string', 'length' => [2, 20]],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['username', 'email'], 'unique'],
            [['newPassword', 'confirmPassword'], 'string', 'length' => [6, 20]],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('app', 'Please enter a valid new password and confirmation password')],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'newPassword' => Yii::t('app', 'New password'),
            'confirmPassword' => Yii::t('app', 'Confirm password'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function createAdmin() {
        if ($this->validate()) {
            $user = new Admin();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = self::STATUS_ACTIVE;
            $user->created_at = time();
            $user->updated_at = time();
            $user->setPassword($this->newPassword);
            $user->generatePasswordResetToken();
            $user->generateAuthKey();
            return $user->save(false);
        }

        return false;
    }

}
