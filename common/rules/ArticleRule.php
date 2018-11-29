<?php

namespace common\rules;

use yii\rbac\Rule;

class ArticleRule extends Rule {

    public $name = 'common\rules\ArticleRule'; //本文件的命名空间加上className，否则auth_rule表中将有两条记录

    /**
     * @param string|integer $user_id 用户 ID.
     * @param Item $item 该规则相关的角色或者权限
     * @param array $params 传给 ManagerInterface::checkAccess() 的参数
     * @return boolean 代表该规则相关的角色或者权限是否被允许
     */

    public function execute($user_id, $item, $params) {
        return true;
    }

}
