<?php

namespace backend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm as YiiActiveForm;

class ActiveForm extends YiiActiveForm {

    const CREATE = 1;
    const UPDATE = 2;
    const DELETE = 3;
    const CREATE_UPDATE = 12;
    const CREATE_DELETE = 13;
    const UPDATE_DELETE = 23;
    const CREATE_UPDATE_DELETE = 123;

    public $options = ['class' => 'form-horizontal'];
    public $fieldConfig = [
        'template' => '{label}<div class="col-md-6">{input}</div><div class="col-md-4">{error}</div>',
        'labelOptions' => ['class' => 'col-md-2 control-label'],
    ];

    /**
     * 静态文字显示
     * @param type $field
     * @param type $text
     * @return type
     */
    public static function staticText($field, $text) {
        return '<div class="form-group"><label class="col-md-2 control-label">' . $field . '</label><div class="col-md-10"><p class="form-control-static">' . $text . '</p></div></div>';
    }

    /**
     * 提交或更新按钮
     * @param type $field
     * @param type $text
     * @return type
     */
    public static function staticSubmitButton($isNew) {
        $text = $isNew ? '<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create') : '<i class="fa fa-edit"></i> ' . Yii::t('app', 'Update');
        $class = $isNew ? 'btn btn-success' : 'btn btn-primary';
        return '<div class="form-group"><div class="col-md-10 col-md-offset-2">' . Html::submitButton($text, ['class' => $class]) . '</div></div>';
    }

    /**
     * 创建链接按钮
     * @param type $type 1创建 2更新 3删除
     * @param type $id
     * @return type
     */
    public static function staticHrefButton($type, $id = null) {
        $html = '';
        $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), Url::to(['create', 'id' => $id]), ['class' => 'btn btn-success']);
        $update = Html::a('<i class="fa fa-edit"></i> ' . Yii::t('app', 'Update'), Url::to(['update', 'id' => $id]), ['class' => 'btn btn-primary']);
        $delete = Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), Url::to(['delete', 'id' => $id]), [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('app', 'Are you sure you want to delete the operation?'),
                    'data-method' => 'post',
        ]);

        switch ($type) {
            case self::CREATE:
                $html = $create;
                break;
            case self::UPDATE:
                $html = $update;
                break;
            case self::DELETE:
                $html = $delete;
                break;
            case self::CREATE_UPDATE:
                $html = $create . ' ' . $update;
                break;
            case self::CREATE_DELETE:
                $html = $create . ' ' . $delete;
                break;
            case self::UPDATE_DELETE:
                $html = $update . ' ' . $delete;
                break;
            case self::CREATE_UPDATE_DELETE:
                $html = $create . ' ' . $update . ' ' . $delete;
                break;
        }

        return '<div class="form-group"><div class="col-md-10 col-md-offset-2">' . $html . '</div>';
    }

    /**
     * 普通输入框
     * @param type $field
     * @param type $model
     * @return type
     */
    public function text($field, $model) {
        return $this->field($model, $field)->textInput(['maxlength' => true]);
    }

    /**
     * 密码输入框
     * @param type $field
     * @param type $model
     * @return type
     */
    public function password($field, $model) {
        return $this->field($model, $field)->passwordInput(['maxlength' => true]);
    }

    /**
     * 隐藏值
     * @param type $field
     * @param type $model
     * @return type
     */
    public function hiddenInput($field, $model, $value) {
        return $this->field($model, $field)->hiddenInput(['value' => $value])->label(false);
    }

    /**
     * 时间选择
     * @param type $field
     * @param type $model
     * @return type
     */
    public function datetime($field, $model) {
        return $this->field($model, $field)->textInput(['class' => 'form-control form-datetime pointer', 'readonly' => 'readonly']);
    }

    /**
     * 日期选择
     * @param type $field
     * @param type $model
     * @return type
     */
    public function formdate($field, $model) {
        return $this->field($model, $field)->textInput(['class' => 'form-control form-date pointer', 'readonly' => 'readonly']);
    }

    /**
     * 单选
     * @param type $field
     * @param type $model
     * @param type $array
     * @return type
     */
    public function radioList($field, $model, $array) {
        return $this->field($model, $field)->radioList($array, ['itemOptions' => ['labelOptions' => ['class' => 'radio-inline']]]);
    }

    /**
     * 复选
     * @param type $field
     * @param type $model
     * @param type $array
     * @return type
     */
    public function checkboxList($field, $model, $array) {
        return $this->field($model, $field)->checkboxList($array, ['itemOptions' => ['labelOptions' => ['class' => 'checkbox-inline']]]);
    }

    /**
     *             
      <div class="form-group">
      <label class="col-md-2 control-label">选择省市县</label>
      <div class="col-md-7">
      <div class="row">
      <?= $form->select($model, 'c_province_id')?>
      <?= $form->select($model, 'c_city_id')?>
      <?= $form->select($model, 'c_area_id') ?>
      </div>
      </div>
      </div>
     */

    /**
     * 下拉
     * @param type $field
     * @param type $model
     * @return type
     */
    public function select($field, $model) {
        return $this->field($model, $field, ['options' => ['class' => 'col-md-4'], 'template' => '{label}<div class="row"><div class="col-md-6">{input}</div><div class="col-md-4">{error}</div></div>'])->dropDownList([])->label(false);
    }

}
