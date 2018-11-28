<?php

namespace backend\widgets;

use Yii;
use yii\helpers\Html;
use yii\grid\ActionColumn as YiiActionColumn;

class ActionColumn extends YiiActionColumn {

    public function init() {
        parent::init();
        $this->initDefaultButtons();
    }

    protected function initDefaultButtons() {
        $this->_initDefaultButton('view', 'eye', 'info');
        $this->_initDefaultButton('update', 'edit', 'primary');
        $this->_initDefaultButton('delete', 'trash', 'danger', [
            'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    protected function _initDefaultButton($name, $iconName, $color, $additionalOptions = []) {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url) use ($name, $iconName, $color, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('app', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('app', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('app', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge(['title' => $title, 'class' => 'btn btn-sm btn-' . $color], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => 'fa fa-' . $iconName]);
                return Html::a($icon, $url, $options);
            };
        }
    }

}
