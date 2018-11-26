<?php

namespace backend\widgets;

use yii\helpers\Html;
use yii\grid\ActionColumn as YiiActionColumn;

class ActionColumn extends YiiActionColumn {

    public function init() {
        parent::init();
        $this->initDefaultButtons();
    }

    protected function initDefaultButtons() {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'edit');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => '确认要删除操作吗？',
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = []) {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = '查看';
                        break;
                    case 'update':
                        $title = '编辑';
                        break;
                    case 'delete':
                        $title = '删除';
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge(['title' => $title, 'aria-label' => $title, 'data-pjax' => '0'], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "fa fa-$iconName"]);
                return Html::a($icon, $url, $options);
            };
        }
    }

}
