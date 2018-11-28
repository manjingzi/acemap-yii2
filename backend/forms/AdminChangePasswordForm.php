<?php

namespace backend\forms;

use Yii;
use common\models\Admin;

class AdminChangePasswordForm extends Admin {

    public $old_password;
    public $new_password;
    public $confirm_password;
    private $_user;

    public function rules() {
        return [
            [['old_password', 'new_password', 'confirm_password'], 'required'],
            [['old_password', 'new_password', 'confirm_password'], 'string', 'length' => [6, 20]],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => Yii::t('app', 'Please enter a valid new password and confirmation password')],
            ['old_password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, Yii::t('app', 'Old password validation failed'));
            }
        }
    }

    public function changePassword() {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->setPassword($this->new_password);
            return $user->save(false);
        }

        return false;
    }

    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = Yii::$app->user->identity;
        }

        return $this->_user;
    }

}
