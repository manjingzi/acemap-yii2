<?php

namespace backend\modules\user\forms;

use Yii;
use common\models\Admin;

class AdminChangePasswordForm extends Admin {

    public $newPassword;
    public $confirmPassword;

    public function rules() {
        return [
            [['newPassword', 'confirmPassword'], 'required'],
            [['newPassword', 'confirmPassword'], 'trim'],
            [['newPassword', 'confirmPassword'], 'string', 'length' => [6, 20]],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('app', 'Please enter a valid new password and confirmation password')],
        ];
    }

    public function changePassword() {
        if ($this->validate()) {
            $this->setPassword($this->newPassword);
            $this->updated_at = time();
            return $this->save(false);
        }

        return false;
    }

}
