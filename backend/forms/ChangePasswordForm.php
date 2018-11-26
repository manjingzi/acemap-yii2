<?php

namespace backend\forms;

use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model {

    public $oldPassword;
    public $newPassword;
    public $confirmPassword;
    private $_user;

    public function rules() {
        return [
            [['oldPassword', 'newPassword', 'confirmPassword'], 'required'],
            [['oldPassword', 'newPassword', 'confirmPassword'], 'string', 'length' => [6, 20]],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('app/admin', 'Please enter a valid new password and confirmation password')],
            ['oldPassword', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'oldPassword' => Yii::t('app/admin', 'Old password'),
            'newPassword' => Yii::t('app/admin', 'New password'),
            'confirmPassword' => Yii::t('app/admin', 'Confirm password'),
        ];
    }

    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user || !$user->validatePassword($this->oldPassword)) {
                $this->addError($attribute, Yii::t('app/admin', 'Old password validation failed'));
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
