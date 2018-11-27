<?php

namespace backend\modules\user\forms;

use common\models\Admin;

class AdminUpdateForm extends Admin {

    public function rules() {
        return [
            [['email', 'status'], 'required'],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function updateAdmin() {
        if ($this->validate()) {
            $this->updated_at = time();
            return $this->save(false);
        }

        return false;
    }

}
