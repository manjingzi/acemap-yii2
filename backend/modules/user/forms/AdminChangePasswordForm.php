<?php

namespace backend\modules\user\forms;

use Yii;
use common\models\Admin;

class AdminChangePasswordForm extends Admin {

    public $new_password;
    public $confirm_password;

    public function rules() {
        return [
            [['new_password', 'confirm_password'], 'required'],
            [['new_password', 'confirm_password'], 'string', 'length' => [6, 20]],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => Yii::t('app', 'Please enter a valid new password and confirmation password')],
        ];
    }

    public function changePassword() {
        if ($this->validate()) {
            $this->setPassword($this->new_password);
            $this->updated_at = time();
            return $this->save(false);
        }

        return false;
    }

}
