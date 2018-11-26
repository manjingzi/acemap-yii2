<?php

namespace backend\widgets;

use yii\widgets\ActiveForm as YiiActiveForm;

class ActiveForm extends YiiActiveForm {

    public $options = ['class' => 'form-horizontal'];
    public $fieldConfig = [
        'template' => '{label}<div class="col-lg-7">{input}</div><div class="col-lg-3">{error}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'], //修改label的样式
    ];

    public function field2($model, $field_name) {
        return $this->field($model, $field_name, ['template' => '{label}<div class="col-lg-2">{input}</div>'])->textInput(['maxlength' => true]);
    }

    public function field3($model, $field_name) {
        return $this->field($model, $field_name, ['template' => '{label}<div class="col-lg-3">{input}</div>'])->textInput(['maxlength' => true]);
    }

    public function field4($model, $field_name) {
        return $this->field($model, $field_name, ['template' => '{label}<div class="col-lg-4">{input}</div>'])->textInput(['maxlength' => true]);
    }

    /**
      <?= $form->datetime($model, 'c_start_time')?>
     */
    public function datetime($model, $field_name) {
        return $this->field($model, $field_name, ['template' => '{label}<div class="col-lg-2">{input}</div>'])->textInput(['class' => 'form-control form-datetime pointer', 'readonly' => 'readonly']);
    }

    public function formdate($model, $field_name) {
        return $this->field($model, $field_name, ['template' => '{label}<div class="col-lg-3">{input}</div>'])->textInput(['class' => 'form-control form-date pointer', 'readonly' => 'readonly']);
    }

    /**
     *             
      <div class="form-group">
      <label class="col-lg-2 control-label">选择省市县</label>
      <div class="col-lg-7">
      <div class="row">
      <?= $form->select($model, 'c_province_id')?>
      <?= $form->select($model, 'c_city_id')?>
      <?= $form->select($model, 'c_area_id') ?>
      </div>
      </div>
      </div>
     */
    public function select($model, $field_name) {
        return $this->field($model, $field_name, ['options' => ['class' => 'col-lg-4'], 'template' => '{label}<div class="row"><div class="col-lg-7">{input}</div><div class="col-lg-5">{error}</div></div>'])->dropDownList([])->label(false);
    }

}
