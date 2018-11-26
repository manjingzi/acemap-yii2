<?php

namespace frontend\controllers;

use Yii;
use common\controllers\BaseController;

class BaseFrontendController extends BaseController {

    //模板类型
    const MAIN_LAYOUT = 1;      // 主页面
    const NAV_LAYOUT = 2;       // 有公共头尾页面
    const NEW_LAYOUT = 6;       // 有公共头尾页面 新样式
    const USER_LAYOUT = 3;      // 用户中心页面
    const BLANK_LAYOUT = 4;     // 空白页面
    const ACENAP_LAYOUT = 5;    //acenap
    const NONE_LAYOUT = 7;      //none

    public $title;
    public $template;

    public function init() {
        parent::init();
        //设置默认语言
        $session = Yii::$app->session;
        $language = $session->get('language');
        if ($language && in_array($language, ['zh-CN', 'en'])) {
            Yii::$app->language = $language;
        } else {
            Yii::$app->language = 'en';
            $session->set('language', 'en');
        }
        $this->template = isset(Yii::$app->params['frontend_template']) && Yii::$app->params['frontend_template'] ? Yii::$app->params['frontend_template'] : 'default';
        $this->layout = '@app/views/' . $this->template . '/layouts/nav.php';
        $this->setViewPath('@app/views/' . $this->template . '/' . $this->id);
    }

    public function setLayout($type = self::NAV_LAYOUT) {
        if (self::MAIN_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/main.php';
        } elseif (self::NAV_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/nav.php';
        } elseif (self::USER_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/user.php';
        } elseif (self::BLANK_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/blank.php';
        } elseif (self::ACENAP_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/acenap.php';
        } elseif (self::NEW_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/new.php';
        } elseif (self::NONE_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/none.php';
        }
    }

}
