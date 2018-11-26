<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;
use yii\base\InvalidConfigException;

class AppAsset extends AssetBundle {

    public $jsOptions = ['position' => View::POS_END];
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/font-awesome/css/font-awesome.min.css',
        'static/adminlte/css/adminlte.min.css',
        'static/adminlte/css/skins/skin-blue.min.css',
    ];
    public $js = [
        'static/bootstrap/js/bootstrap.min.js',
        'static/adminlte/js/adminlte.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后  
    public static function addJs($view, $jsfile, $end = true) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset', 'position' => $end ? View::POS_END : View::POS_HEAD]);
    }

    //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset', 'position' => $view::POS_HEAD]);
    }

    //将需要加载的文件已数组聚合后在加载
    public static function addJsArr($view, $arr = null) {
        if (!is_array($arr)) {
            throw new InvalidConfigException('the seconed params must be array type!');
        }
        foreach ($arr as $jsfile) {
            $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset', 'position' => $view::POS_END]);
        }
    }

    //将需要加载的文件已数组聚合后在加载
    public static function addCssArr($view, $arr = null) {
        if (!is_array($arr)) {
            throw new InvalidConfigException('the seconed params must be array type!');
        }
        foreach ($arr as $cssfile) {
            $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset', 'position' => $view::POS_END]);
        }
    }

}
