<?php

namespace backend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm as YiiActiveForm;

class ActiveForm extends YiiActiveForm {

    const CREATE = 1;
    const UPDATE = 2;
    const PASSWORD = 3;
    const DELETE = 4;
    const SEARCH = 5;
    const RESET = 6;
    const CREATE_UPDATE = 12;
    const CREATE_DELETE = 14;
    const UPDATE_DELETE = 24;
    const CREATE_UPDATE_DELETE = 124;

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
     * 提交按钮
     * @param type $type
     * @param type $wrapper
     * @return type
     */
    public static function staticButton($type, $wrapper = false) {
        $class = '';
        $text = '';

        switch ($type) {
            case self::CREATE:
                $class = 'btn btn-success';
                $text = '<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create');
                break;
            case self::UPDATE:
                $class = 'btn btn-primary';
                $text = '<i class="fa fa-edit"></i> ' . Yii::t('app', 'Update');
                break;
            case self::PASSWORD:
                $class = 'btn btn-warning';
                $text = '<i class="fa fa-lock"></i> ' . Yii::t('app', 'Change password');
                break;
            case self::DELETE:
                $class = 'btn btn-danger';
                $text = '<i class="fa fa-trash"></i> ' . Yii::t('app', 'Update');
                break;
            case self::SEARCH:
                $class = 'btn btn-primary';
                $text = '<i class="fa fa-search"></i> ' . Yii::t('app', 'Search');
                break;
            case self::RESET:
                $class = 'btn btn-default';
                $text = Yii::t('app', 'Reset');
                break;
        }

        $button = Html::submitButton($text, ['class' => $class]);

        if ($type == self::RESET) {
            $button = Html::resetButton($text, ['class' => $class]);
        }

        if ($wrapper) {
            return '<div class="form-group"><div class="col-md-10 col-md-offset-2">' . $button . '</div></div>';
        } else {
            return $button;
        }
    }

    public static function staticSubmitButton($isNew = true) {
        return self::staticButton($isNew ? self::CREATE : self::UPDATE, true);
    }

    public static function staticPasswordSubmitButton() {
        return self::staticButton(self::PASSWORD, true);
    }

    /**
     * 链接按钮
     * @param type $type
     * @param type $id
     * @return type
     */
    public static function staticHrefButton($type, $id = null) {
        $html = '';
        $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create'), Url::to(['create', 'id' => $id]), ['class' => 'btn btn-success']) . ' ';
        $update = Html::a('<i class="fa fa-edit"></i> ' . Yii::t('app', 'Update'), Url::to(['update', 'id' => $id]), ['class' => 'btn btn-primary']) . ' ';
        $password = Html::a('<i class="fa fa-lock"></i> ' . Yii::t('app', 'Change password'), Url::to(['change-password', 'id' => $id]), ['class' => 'btn btn-warning']) . ' ';
        $delete = Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Delete'), Url::to(['delete', 'id' => $id]), [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
        ]);

        $reset = Html::a(Yii::t('app', 'Reset'), Url::to(['index']), ['class' => 'btn btn-default']);

        switch ($type) {
            case self::CREATE:
                $html = $create;
                break;
            case self::UPDATE:
                $html = $update;
                break;
            case self::PASSWORD:
                $html = $password;
                break;
            case self::DELETE:
                $html = $delete;
                break;
            case self::RESET:
                $html = $reset;
                break;
            case self::CREATE_UPDATE:
                $html = $create . $update;
                break;
            case self::CREATE_DELETE:
                $html = $create . $delete;
                break;
            case self::UPDATE_DELETE:
                $html = $update . $delete;
                break;
            case self::CREATE_UPDATE_DELETE:
                $html = $create . $update . $delete;
                break;
        }

        if ($type > self::RESET) {
            return '<div class="form-group"><div class="col-md-10 col-md-offset-2">' . $html . '</div>';
        }

        return $html;
    }

    /**
     *  创建链接按钮
     */
    public static function staticCreateButton($id = null, $wrapper = false) {
        return self::staticHrefButton(self::CREATE, $id, $wrapper);
    }

    /**
     *  更新链接按钮
     */
    public static function staticUpdateButton($id = null, $wrapper = false) {
        return self::staticHrefButton(self::UPDATE, $id, $wrapper);
    }

    /**
     *  密码链接按钮
     */
    public static function staticPasswordButton($id = null, $wrapper = false) {
        return self::staticHrefButton(self::PASSWORD, $id, $wrapper);
    }

    /**
     *  删除链接按钮
     */
    public static function staticDeleteButton($id = null, $wrapper = false) {
        return self::staticHrefButton(self::DELETE, $id, $wrapper);
    }

    /**
     * 普通输入框
     * @param type $field
     * @param type $model
     * @return type
     */
    public function text($field, $model, $defaultValue = null) {
        return $this->field($model, $field)->textInput(['maxlength' => true, 'value' => $defaultValue]);
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

    public function dropDownList($field, $model, $array, $defaultValue = null, $prompt = null) {
        return $this->field($model, $field)->dropDownList($array, ['prompt' => $prompt, 'value' => $defaultValue]);
    }

    public function selectPagesize($model, $field = 'pagesize') {
        return $this->dropDownList($field, $model, $model::getPageSize(), $model::getSearchParams($field), Yii::t('app', 'Select pagesize'));
    }

    public function selectStatus($model, $field = 'status') {
        return $this->dropDownList($field, $model, $model::getStatusText(), $model::getSearchParams($field), Yii::t('app', 'Select status'));
    }

    public function radioListStatus($model, $field = 'status') {
        return $this->field($model, $field)->radioList($model::getStatusText(), ['itemOptions' => ['labelOptions' => ['class' => 'radio-inline']]]);
    }

    /**
     * 关键词查询
     * @param type $model  
     * @param type $field
     * @return type
     */
    public function searchKeyword($model, $field = 'keyword') {
        return $this->field($model, $field)->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Please enter keywords'), 'value' => $model::getSearchParams($field)]);
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
