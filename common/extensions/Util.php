<?php

namespace common\extensions;

class Util {

    /**
     * 高亮关键词
     * @param type $keyword
     * @param type $search_str
     * @return type
     */
    public static function highlight($keyword, $search_str) {
        return $keyword && $search_str ? str_replace($keyword, '<b class="text-danger">' . $keyword . '</b>', $search_str) : $search_str;
    }

    /**
     * 过滤特殊字符
     * @param type $str
     * @return type
     */
    public static function filterString($str) {
        return $str ? strip_tags(trim($str)) : $str;
    }

    /**
     * 过滤特殊字符
     * @param type $str
     * @return type
     */
    public static function filterStringRelace($str) {
        return $str ? str_replace("\t", '', str_replace(' ', '', str_replace("\r", '', str_replace("\n", '', self::filterString($str))))) : $str;
    }

    /**
     * 过滤特殊字符 字母格式化为小写
     * @param type $str
     * @return type
     */
    public static function filterStringLower($str) {
        return $str ? strtolower(self::filterStringRelace($str)) : $str;
    }

    /**
     * 手机号隐藏中间四位
     * @param type $mobile
     * @return type
     */
    public static function hiddenMobile($mobile) {
        if (self::checkMobile($mobile)) {
            return substr_replace($mobile, '****', 3, 4);
        }
        return $mobile;
    }

    /**
     * 邮箱显示@字符串的前一后一
     * @param type $email
     * @return type
     */
    public static function hiddenEmail($email) {
        if (self::checkEmail($email)) {
            $prefix = strstr($email, '@', true);
            if ($prefix !== false) {
                return substr($prefix, 0, 1) . '****' . substr($prefix, -1) . strstr($email, '@');
            }
        }
        return $email;
    }

    /**
     * 字符加密函数 加密后为44位长度
     * @param type $txt
     * @param type $key
     * @return type
     */
    static function encodeUrl($txt, $key = 'wxherp') {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+';
        $nh = rand(0, 64);
        $ch = $chars[$nh];
        $mdKey = substr(md5($key . $ch), $nh % 8, $nh % 8 + 7);
        $txtKey = base64_encode($txt . $key);
        $tmp = '';
        $i = 0;
        $j = 0;
        $k = 0;
        for ($i = 0; $i < strlen($txtKey); $i++) {
            $k = $k == strlen($mdKey) ? 0 : $k;
            $j = ($nh + strpos($chars, $txtKey[$i]) + ord($mdKey[$k++])) % 64;
            $tmp .= $chars[$j];
        }
        return urlencode(base64_encode($ch . $tmp));
    }

    /**
     * 解密函数
     * @param type $txt
     * @param type $key
     * @return type
     */
    static function decodeUrl($txt, $key = 'wxherp') {
        if (strlen($txt) == 44) {
            $txt = base64_decode(urldecode($txt));
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+';
            $ch = $txt[0];
            $nh = strpos($chars, $ch);
            $mdKey = substr(md5($key . $ch), $nh % 8, $nh % 8 + 7);
            $txtLast = substr($txt, 1);
            $tmp = '';
            $i = $j = $k = 0;
            for ($i = 0; $i < strlen($txtLast); $i++) {
                $k = $k == strlen($mdKey) ? 0 : $k;
                $j = strpos($chars, $txtLast[$i]) - $nh - ord($mdKey[$k++]);
                while ($j < 0) {
                    $j += 64;
                }
                $tmp .= $chars[$j];
            }
            return trim(base64_decode($tmp), $key);
        }
    }

    /**
     * 获取数组重复的数据
     * @param type $array
     * @return type
     */
    public static function getRepeatArray($array) {
        // 获取去掉重复数据的数组 
        $unique_arr = array_unique($array);
        // 获取重复数据的数组 
        return array_diff_assoc($array, $unique_arr);
    }

    /**
     * 二维数组转成浏览器参数 格式 a=1&b=2
     * @param type $array 格式 [a=>1,b=>2]
     * @return string
     */
    public static function arrayToString($array) {
        $_array = [];
        foreach ($array as $k => $v) {
            $_array[] = $k . '=' . $v;
        }
        return implode('&', $_array);
    }

    /**
     * 检测手机号是否合法
     * @param string $mobile
     * @return bool 
     */
    public static function checkMobile($mobile) {
        if (preg_match("/1[34578]\d{9}$/", $mobile)) {
            return true;
        }
        return false;
    }

    /**
     * 检测邮箱是否合法
     * @param type $email
     * @return boolean
     */
    public static function checkEmail($email) {
        if (preg_match('/^[a-zA-Z0-9._%+-]+@(?!.*\.\..*)[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email)) {
            return true;
        }
        return false;
    }

    /**
     * 检测用户名是否合法
     * @param type $username
     * @return boolean
     */
    public static function checkUsername($username) {
        if (preg_match('/^[a-z0-9_\u4E00-\u9FA5]+[^_]$/', $username)) {
            return true;
        }
        return false;
    }

    /**
     * 检查身份账号的格式是否正确
     * $id 身份证id
     */
    public static function checkId($id) {
        if (strlen($id) == 18) {
            return self::checkId18($id);
        } elseif ((strlen($id) == 15)) {
            $id = self::idTo18($id);
            return self::checkId18($id);
        }
        return false;
    }

    /**
     * 计算身份证校验码，根据国家标准GB 11643-1999 
     * @param type $id
     * @return boolean|string
     */
    public static function verifyId($id) {
        if (strlen($id) != 17) {
            return false;
        }
        //加权因子 
        $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        //校验码对应值 
        $list = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        $sum = 0;
        for ($i = 0; $i < strlen($id); $i++) {
            $sum += substr($id, $i, 1) * $factor[$i];
        }
        $mod = $sum % 11;
        return $list[$mod];
    }

    /**
     * 将15位身份证升级到18位
     * @param type $id
     * @return boolean
     */
    public static function idTo18($id) {
        if (strlen($id) != 15) {
            return false;
        } else {
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码 
            if (array_search(substr($id, 12, 3), array('996', '997', '998', '999')) !== false) {
                $id = substr($id, 0, 6) . '18' . substr($id, 6, 9);
            } else {
                $id = substr($id, 0, 6) . '19' . substr($id, 6, 9);
            }
        }
        return $id . self::verifyId($id);
    }

    /**
     * 18位身份证校验码有效性检查
     * @param type $id
     * @return boolean
     */
    public static function checkId18($id) {
        if (strlen($id) != 18) {
            return false;
        }
        if (self::verifyId(substr($id, 0, 17)) != strtoupper(substr($id, 17, 1))) {
            return false;
        }
        return true;
    }

    /**
     * 检查车牌
     * @param type $number
     * @return boolean
     */
    public static function checkCarNumber($number) {
        if (preg_match("/^[\x{4E00}-\x{9FA5}][A-Z][A-Z0-9]{5}$/u", $number)) {
            return true;
        }
        return false;
    }

    /**
     * 获取文件目录列表
     * @param type $dir
     * @return type
     */
    public static function getDir($dir) {
        $dir_array = [];
        if (false != ($handle = opendir($dir))) {
            while (false !== ($file = readdir($handle))) {
                //去掉“.”、“..”以及带“.xxx”后缀的文件
                if ($file != '.' && $file != '..' && is_dir($dir . DIRECTORY_SEPARATOR . $file)) {
                    $dir_array[] = $file;
                }
            }
            closedir($handle);
        }
        return $dir_array;
    }

    /**
     * 获取文件列表
     * @param type $dir
     * @return type
     */
    public static function getFile($dir) {
        $file_array = null;
        if (false != ($handle = opendir($dir))) {
            while (false !== ($file = readdir($handle))) {
                //去掉“.”、“..”以及带“.xxx”后缀的文件
                if ($file != '.' && $file != '..' && is_file($dir . DIRECTORY_SEPARATOR . $file)) {
                    $file_array[] = $file;
                }
            }
            closedir($handle);
        }
        return $file_array;
    }

    /**
     * 循环删除目录和文件函数
     * @param type $dir
     */
    public static function deleteDirAndFile($dir) {
        if (false != ($handle = opendir($dir))) {
            while (false !== ( $item = readdir($handle) )) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $item)) {
                        self::deleteDirAndFile($dir . DIRECTORY_SEPARATOR . $item);
                    } else {
                        unlink($dir . DIRECTORY_SEPARATOR . $item);
                    }
                }
            }
            closedir($handle);
            rmdir($dir);
        }
    }

    /**
     * 自动创建多目录
     * @param type $path 创建的目录的绝对路径
     * @param type $is_file 是否是文件 
     * @param type $mode 模式
     * @return boolean
     */
    public static function createDirList($path, $is_file = true, $mode = 0755) {
        if ($is_file) {
            $pathinfo = pathinfo($path);
            $path = $pathinfo['dirname'];
        }
        if (is_dir($path)) {
            return true;
        } else {
            return mkdir(iconv('utf-8', 'gbk', $path), $mode, true); //第三个参数为true即可以创建多级目录
        }
    }

    /**
     * 存储日志
     * @param type $data
     */
    public static function log($data) {
        $log = is_array($data) || is_object($data) ? print_r($data, true) : $data;
        file_put_contents('log.txt', date('Y-m-d:H:i:s') . $log . "\n", FILE_APPEND);
    }

    public static function alert($msg) {
        echo '<script>alert(\'' . $msg . '\')</script>';
        exit;
    }

    /**
     * 金额格式化
     * @param float $value 金额
     * @return float 格式化后的金额
     */
    public static function formatMoney($value) {
        return round($value, 2);
    }

    public static function formatTimes($time) {
        $t = time() - $time;
        $f = array(
            '31536000' => '年',
            '2592000' => '个月',
            '604800' => '星期',
            '86400' => '天',
            '3600' => '小时',
            '60' => '分钟',
            '1' => '秒'
        );
        foreach ($f as $k => $v) {
            if (0 != $c = floor($t / (int) $k)) {
                return $c . $v . '前';
            }
        }
    }

    /**
     * 格式化重量单位
     * @param type $weight
     * @return type
     */
    public static function formatWeight($weight) {
        if ($weight >= 1000) {
            return ($weight / 1000) . '千克';
        } else {
            return $weight . '克';
        }
    }

    public static function convertUTF8($str) {
        if (empty($str)) {
            return '';
        }
        return iconv('GB18030', 'UTF-8', $str);
    }

    public static function convertGB($str) {
        if (empty($str)) {
            return '';
        }
        return iconv('UTF-8', 'GB18030', $str);
    }

    public static function microtimeFloat() {
        list($usec, $sec) = explode(' ', microtime());
        return ((float) $usec + (float) $sec);
    }

}
