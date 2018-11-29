<?php

namespace backend\forms;

use Yii;
use common\models\Admin;

class AdminChangePasswordForm extends Admin {

    public $oldPassword;
    public $newPassword;
    public $confirmPassword;
    private $_user;

    public function rules() {
        return [
            [['oldPassword', 'newPassword', 'confirmPassword'], 'required'],
            [['oldPassword', 'newPassword', 'confirmPassword'], 'trim'],
            [['oldPassword', 'newPassword', 'confirmPassword'], 'string', 'length' => [6, 20]],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('app', 'Please enter a valid new password and confirmation password')],
            ['oldPassword', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->oldPassword)) {
                $this->addError($attribute, Yii::t('app', 'Old password validation failed'));
            }
        }
    }

    public function changePassword() {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->setPassword($this->newPassword);
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
