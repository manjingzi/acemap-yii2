<?php

namespace backend\widgets;

use Yii;
use yii\widgets\ActiveForm as YiiActiveForm;

class ActiveForm extends YiiActiveForm {

    public $options = ['class' => 'form-horizontal'];
    public $fieldConfig = [
        'template' => '{label}<div class="col-md-6">{input}</div><div class="col-md-4">{error}</div>',
        'labelOptions' => ['class' => 'col-md-2 control-label'],
    ];

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
     * 多行输入框
     * @param type $field
     * @param type $model
     * @return type
     */
    public function textarea($field, $model, $rows = 2) {
        return $this->field($model, $field)->textarea(['rows' => $rows]);
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
