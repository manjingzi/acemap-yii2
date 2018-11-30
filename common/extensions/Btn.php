<?php

namespace common\extensions;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

class Btn {

    /**
     * 静态文字显示
     * @param type $field
     * @param type $text
     * @return type
     */
    public static function staticText($field, $text) {
        return '<div class="form-group"><label class="col-md-2 control-label">' . $field . '</label><div class="col-md-10"><p class="form-control-static">' . $text . '</p></div></div>';
    }

    public static function createSubmitButton($id = 'btn-create') {
        $class = 'btn btn-success';
        $text = '<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create');
        return Html::submitButton($text, ['class' => $class, 'id' => $id]);
    }

    public static function updateSubmitButton($id = 'btn-update') {
        $class = 'btn btn-primary';
        $text = '<i class="fa fa-lock"></i> ' . Yii::t('app', 'Update');
        return Html::submitButton($text, ['class' => $class, 'id' => $id]);
    }

    public static function changePasswordSubmitButton($id = 'btn-change-password') {
        $class = 'btn btn-warning';
        $text = '<i class="fa fa-lock"></i> ' . Yii::t('app', 'Change password');
        return Html::submitButton($text, ['class' => $class, 'id' => $id]);
    }

    public static function deleteSubmitButton($id = 'btn-delete') {
        $class = 'btn btn-danger';
        $text = '<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete');
        return Html::submitButton($text, ['class' => $class, 'id' => $id]);
    }

    public static function searchSubmitButton($id = 'btn-search') {
        $class = 'btn btn-primary';
        $text = '<i class="fa fa-search"></i> ' . Yii::t('app', 'Search');
        return Html::submitButton($text, ['class' => $class, 'id' => $id]);
    }

    public static function resetButton($id = 'btn-reset') {
        $class = 'btn btn-default';
        $text = Yii::t('app', 'Reset');
        return Html::submitButton($text, ['class' => $class, 'id' => $id]);
    }

    /**
     *  创建链接按钮
     */
    public static function createHrefButton($id = null) {
        return Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), Url::to(['create', 'id' => $id]), ['class' => 'btn btn-success']);
    }

    /**
     *  更新链接按钮
     */
    public static function updateHrefButton($id = null) {
        return Html::a('<i class="fa fa-edit"></i> ' . Yii::t('app', 'Update'), Url::to(['update', 'id' => $id]), ['class' => 'btn btn-primary']);
    }

    /**
     *  密码链接按钮
     */
    public static function changePasswordHrefButton($id = null) {
        return Html::a('<i class="fa fa-lock"></i> ' . Yii::t('app', 'Change password'), Url::to(['change-password', 'id' => $id]), ['class' => 'btn btn-warning']);
    }

    /**
     *  删除链接按钮
     */
    public static function deleteHrefButton($id = null) {
        return Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), Url::to(['delete', 'id' => $id]), [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
        ]);
    }

}
