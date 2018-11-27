<?php

namespace backend\controllers;

use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\Controller;
use common\models\BaseModel;
use common\models\AdminOperationLog;

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

    protected function setError($msg = null, $model = null) {
        if ($model) {
            $error = $model->getFirstErrors();
            if ($error) {
                $msg = array_values($error)[0];
            }
        }

        Yii::$app->getSession()->setFlash('error', $msg ?: Yii::t('app', 'Operation result failed'));
    }

    protected function setSuccess($msg = null) {
        Yii::$app->getSession()->setFlash('success', $msg ?: Yii::t('app', 'Successful operation result'));
    }

    /**
     * 公共模块创建
     * @param type $model 模型
     * @param type $data 自定义数据格式 [模型名称=>数据数组] 如: [Ad => ['title'=>'test','status'=>1]] 默认是接收POST数据
     * @return boolean
     */
    protected function commonCreate($model, $data = null) {
        if (is_null($data)) {
            $data = Yii::$app->request->post();
        }
        if ($model->load($data)) {
            if (array_key_exists('created_at', $model->attributes)) {
                $model->created_at = time();
            }

            if ($model->validate()) {
                $result = $model->save();
                $log['status'] = $result ? BaseModel::STATUS_ACTIVE : BaseModel::STATUS_DELETED;
                $log['object_id'] = $model->id;
                $log['data_add'] = json_encode($model->attributes, JSON_UNESCAPED_UNICODE);
                $log['data_before'] = json_encode(null, JSON_UNESCAPED_UNICODE);
                $this->adminLog($log);
                if ($result) {
                    $this->setSuccess();
                    return true;
                } else {
                    $this->setError(null, $model);
                    return false;
                }
            } else {
                $this->setError(Yii::t('app', 'New data validation failed'), $model);
                return false;
            }
        } else {
            $this->setError(null, Yii::t('app', 'Please check if the model name in the template is correct'));
            return false;
        }
    }

    /**
     * 公共模块更新
     * @param type $model 模型
     * @param type $data 自定义数据格式 [模型名称=>数据数组] 如: [Ad => ['title'=>'test','status'=>1]] 默认是接收POST数据
     * @param type $create_type 来源类型
     * @return boolean
     */
    protected function commonUpdate($model, $data = null) {
        $data_before = $model->attributes; //在本次更新之前的数据
        if (is_null($data)) {
            $data = Yii::$app->request->post();
        }
        if ($model->load($data)) {
            if ($model->validate()) {
                $result = $model->save();
                $log['status'] = $result ? BaseModel::STATUS_ACTIVE : BaseModel::STATUS_DELETED;
                $log['object_id'] = $model->id;
                $log['data_add'] = json_encode($model->attributes, JSON_UNESCAPED_UNICODE);
                $log['data_before'] = json_encode($data_before, JSON_UNESCAPED_UNICODE);
                $this->adminLog($log);
                if ($result) {
                    $this->setSuccess();
                    return true;
                } else {
                    $this->setError(null, $model);
                    return false;
                }
            } else {
                $this->setError(Yii::t('app', 'New data validation failed'), $model);
                return false;
            }
        } else {
            $this->setError(null, Yii::t('app', 'Please check if the model name in the template is correct'));
            return false;
        }
    }

    /**
     * 删除操作 可批量删除
     * @param type $modelClass 模型class
     * @param type $id 
     * @param type $create_type 来源类型
     * @return boolean
     */
    protected function commonDelete($modelClass, $id = null) {
        if ($id === null) {
            $id = explode(',', Yii::$app->request->post('id'));
        } else {
            $id = (int) $id;
        }
        if ($id) {
            $list = $modelClass::find()->where(['id' => $id])->all();
            foreach ($list as $model) {
                $result = $model->delete();
                $log['status'] = $result ? BaseModel::STATUS_ACTIVE : BaseModel::STATUS_DELETED;
                $log['object_id'] = $model->id;
                $log['data_add'] = json_encode($model->attributes, JSON_UNESCAPED_UNICODE);
                $log['data_before'] = json_encode(null, JSON_UNESCAPED_UNICODE);
                $this->adminLog($log);
                if ($model->getErrors()) {
                    $this->setError(null, $model);
                    return false;
                }
            }
            $this->setSuccess();
            return true;
        } else {
            $this->setError(Yii::t('app', 'Parameter error'));
            return false;
        }
    }

    /**
     * 按自定义字段更新字段值 可批量操作 $id, $value, $field = 'status'
     * @param type $modelClass 模型class
     * @param type $condition 查询条件数组 如果为整形则创建自增ID查询数组
     * @param type $fieldsUpdate 更新数组  ['status' => BaseModel::STATUS_DELETED]
     * @return boolean
     */
    protected function commonUpdateByField($modelClass, $condition, $fieldsUpdate) {
        if (is_numeric($condition)) {
            $condition = ['id' => $condition];
        }

        $result = $modelClass::updateAll($fieldsUpdate, $condition);
        $log['status'] = $result ? BaseModel::STATUS_ACTIVE : BaseModel::STATUS_DELETED;
        $log['object_id'] = 0;
        $log['data_add'] = json_encode(ArrayHelper::merge($fieldsUpdate, $condition), JSON_UNESCAPED_UNICODE);
        $log['data_before'] = json_encode(null, JSON_UNESCAPED_UNICODE);
        $this->adminLog($log);

        if ($result) {
            $this->setSuccess();
            return true;
        } else {
            $this->setError();
            return false;
        }
    }

    /**
     *  加入操作日志
     * @param type $type 操作类型 1新增 2更新 3删除
     * @param type $status 操作结果状态 1成功 2失败
     * @param type $id 操作对象的ID
     * @param type $data_before 在本次更新或删除之前的数据
     * @param type $data_add 本次新增或更新的数据
     */
    protected function adminLog($data) {
        $data['route'] = Yii::$app->controller->getRoute();
        AdminOperationLog::add($data);
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
