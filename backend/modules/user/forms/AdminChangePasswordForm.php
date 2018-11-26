<?php

namespace backend\modules\user\forms;

use Yii;
use yii\base\Model;
use common\models\Admin;
use yii\web\NotFoundHttpException;

class AdminChangePasswordForm extends Model {

    public $user_id;
    public $username;
    public $newPassword;
    public $confirmPassword;
    private $_user;

    public function __construct($id) {
        parent::__construct();
        $this->user_id = $id;
        $this->username = $this->getUser()->username;
    }

    public function rules() {
        return [
            [['newPassword', 'confirmPassword'], 'required'],
            [['newPassword', 'confirmPassword'], 'string', 'length' => [6, 20]],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('app/admin', 'Please enter a valid new password and confirmation password')],
        ];
    }

    public function attributeLabels() {
        return [
            'newPassword' => Yii::t('app/admin', 'New password'),
            'confirmPassword' => Yii::t('app/admin', 'Confirm password'),
        ];
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
            $this->_user = $this->findModel($this->user_id);
        }

        return $this->_user;
    }

    protected function findModel($id) {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
