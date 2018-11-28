<?php

namespace backend\widgets;

class SearchForm extends ActiveForm {

    public $enableClientValidation = false;
    public $method = 'get';
    public $options = ['class' => 'form-inline', ['options' => ['role' => 'form']]];
    public $fieldConfig = ['template' => '{input}'];

}
