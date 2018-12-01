<?php

namespace common\models;

use Yii;

class BaseModel extends \yii\db\ActiveRecord {

    const STATUS_ACTIVE = 1; //正常
    const STATUS_DELETED = 2; //无效

    public static function setError($model = null, $msg = null) {
        if ($model) {
            $error = $model->getFirstErrors();
            if ($error) {
                $msg = array_values($error)[0];
            }
        }

        Yii::$app->getSession()->setFlash('error', $msg ? $msg : Yii::t('app/error', 'Operation result failed'));
    }

    public static function setSuccess($msg = null) {
        Yii::$app->getSession()->setFlash('success', $msg ? $msg : Yii::t('app/error', 'Successful operation result'));
    }

    /**
     * 通用自定义数组显示状态
     * @param type $array
     * @param type $type
     * @return boolean
     */
    public static function getCommonStatus($array, $type = null) {
        if (is_null($type)) {
            return $array;
        } elseif (isset($array[$type])) {
            return $array[$type];
        }
        return false;
    }

    public static function getStatusText($type = null, $data = null) {
        $array = $data ?: [self::STATUS_ACTIVE => Yii::t('app', 'Normal'), self::STATUS_DELETED => Yii::t('app', 'Invalid')];
        return self::getCommonStatus($array, $type);
    }

    public static function getStatusIcon($type = null, $data = null) {
        $array = $data ?: [
            self::STATUS_ACTIVE => [Yii::t('app', 'Normal'), 'check-circle', 'text-success'],
            self::STATUS_DELETED => [Yii::t('app', 'Invalid'), 'times-circle', 'text-danger']
        ];

        if (is_null($type)) {
            return $array;
        } elseif (isset($array[$type])) {
            return '<i class="' . $array[$type][2] . ' fa fa-' . $array[$type][1] . '" title="' . $array[$type][0] . '"></i>';
        }
        return false;
    }

    /**
     * 格式化查询时间段
     * @param type $time_field 搜索字段
     * @param type $start_time 开始时间
     * @param type $end_time 结束时间
     * @return string
     */
    public static function formatSearchTime($time_field, $start_time = null, $end_time = null) {
        $where = [];
        if ($start_time && empty($end_time)) {
            $where[] = ['>=', $time_field, strtotime($start_time)];
        } elseif (empty($start_time) && $end_time) {
            $where[] = ['<=', $time_field, strtotime($end_time) + 86400];
        } elseif ($start_time && $end_time && $start_time < $end_time) {
            $where[] = ['>=', $time_field, strtotime($start_time)];
            $where[] = ['<=', $time_field, strtotime($end_time) + 86400];
        } elseif ($start_time && $end_time && $start_time > $end_time) {//谁的日期大就当做结束日期，相反就是开始日期
            $where[] = ['>=', $time_field, strtotime($end_time)];
            $where[] = ['<=', $time_field, strtotime($start_time) + 86400];
        } elseif ($start_time && $start_time == $end_time) {
            $where[] = ['>=', $time_field, strtotime($start_time)];
            $where[] = ['<=', $time_field, strtotime($start_time) + 86400];
        }
        return $where;
    }

    /**
     * 分页
     * @return type
     */
    public static function getPageSize() {
        return [
            5 => '5 ' . Yii::t('app', 'Record'),
            10 => '10 ' . Yii::t('app', 'Record'),
            15 => '15 ' . Yii::t('app', 'Record'),
            20 => '20 ' . Yii::t('app', 'Record'),
            30 => '30 ' . Yii::t('app', 'Record'),
            40 => '40 ' . Yii::t('app', 'Record'),
            50 => '50 ' . Yii::t('app', 'Record'),
            100 => '100 ' . Yii::t('app', 'Record'),
            150 => '150 ' . Yii::t('app', 'Record'),
            200 => '200 ' . Yii::t('app', 'Record'),
        ];
    }

    /**
     * 获取Search GET传值
     * @param type $field_name 字段名
     * @param type $default_value 默认值
     * @return type
     */
    public static function getSearchParams($field_name, $default_value = null) {
        $name = basename(get_called_class());
        $params = Yii::$app->getRequest()->get($name . 'Search');

        if (isset($params[$field_name])) {
            return $params[$field_name];
        }

        return $default_value;
    }

    /**
     * 格式化树形数组
     * @param type $data 输入二位数组
     * @param type $config 字段映射配置
     * @return type
     */
    public static function getTree($data) {
        //解决下标不是1开始的问题
        $items = [];
        foreach ($data as $value) {
            $items[$value['id']] = $value;
        }

        //开始组装
        $tree = [];
        foreach ($items as $key => $item) {
            if ($item['pid'] == 0) { //为0，则为1级分类
                $tree[] = &$items[$key];
            } else {
                if (isset($items[$item['pid']])) { //存在值则为二级分类
                    $items[$item['pid']]['sub'][] = &$items[$key]; //传引用直接赋值与改变
                } else {
                    $tree[] = &$items[$key]; //至少三级分类 由于是传引用思想，这里将不会有值
                }
            }
        }
        return $tree;
    }

    public static function getCache($name) {
        return Yii::$app->cache->get($name);
    }

    public static function setCache($name, $data, $cache_time = 0) {
        return Yii::$app->cache->set($name, $data, $cache_time);
    }

    public static function delCache($name) {
        return Yii::$app->cache->delete($name);
    }

}
