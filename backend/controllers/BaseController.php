<?php

namespace backend\controllers;

use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\Controller;

class BaseController extends Controller {

    public function init() {
        parent::init();
        $lang = Yii::$app->session->get('lang');
        if ($lang) {
            Yii::$app->language = $lang;
        } else {
            Yii::$app->language = 'zh-CN';
            Yii::$app->session->set('lang', 'zh-CN');
        }
    }

    protected static function jsonEcho($array) {
        echo json_encode($array);
        exit;
    }

//
//    /**
//     *  Ajax返回状态信息
//     * @param type $msg 信息提示
//     * @param type $type 
//     * 1  弹出信息，3秒后自动消失 
//     * 2  弹出信息，2秒后自动重定向，URL参数必填
//     * 3  弹出信息，2秒后自动重载当前页
//     * 4  弹出信息，2秒后自动返回上一页
//     * 5  无信息提示，自动重定向，URL参数必填
//     * 6  无信息提示，自动重载当前页
//     * 7  无信息提示，自动返回上一页
//     * @param type $url 重定向连接
//     */
//    protected function ajaxSuccess($msg = null, $type = 3, $url = '') {
//        if (empty($msg)) {
//            $msg = Yii::t('system', 'system_operation_success');
//        }
//        $array['status'] = 0;
//        $array['type'] = $type;
//        $array['msg'] = $msg;
//        $array['url'] = $url;
//        self::jsonEcho($array);
//    }
//
//    /**
//     *  Ajax返回状态信息
//     * @param type $msg 信息提示
//     * @param type $type 
//     * 0  关闭弹窗
//     * 1  弹出信息，2秒后自动消失 
//     * 2  弹出信息，自动重定向，URL参数必填
//     * 3  弹出信息，自动重载当前页
//     * 4  弹出信息，自动返回上一页
//     * 5  无信息提示，自动重定向，URL参数必填
//     * 6  无信息提示，自动重载当前页
//     * 7  无信息提示，自动返回上一页
//     * @param type $url 重定向连接
//     */
//    protected function ajaxError($msg = null, $type = 1, $url = '') {
//        if (empty($msg)) {
//            $msg = Yii::t('system', 'system_operation_fail');
//        }
//        $array['status'] = 1;
//        $array['type'] = $type;
//        $array['msg'] = $msg;
//        $array['url'] = $url;
//        self::jsonEcho($array);
//    }
//
//    /**
//     * 刷新
//     */
//    protected function ajaxRefresh() {
//        $this->ajaxSuccess(null, 6);
//    }
//
//    /**
//     * 跳转
//     */
//    protected function ajaxJump($url) {
//        $this->ajaxSuccess(null, 5, $url);
//    }
//
//    /**
//     * 跳转
//     */
//    protected function ajaxMsgJump($url, $msg = null) {
//        $this->ajaxSuccess($msg, 2, $url);
//    }
//
//    public function beforeAction($action) {
//
//        print_r($action);
//        exit;
//        if (!parent::beforeAction($action)) {
//            return false; //如果父类验证失败,则返回失败
//        }
//
//        $permission = $action->controller->module->requestedRoute; //记录我们访问的规则名称
//        echo $permission;
//        exit;
//        if (Yii::$app->user->can($permission)) {
//            return true; //如该用户能访问该请求，则进行返回
//        }
//
//        throw new UnauthorizedHttpException(' 你没有该权限 '); //如果没有该权限，抛出一个异常
//    }
}
