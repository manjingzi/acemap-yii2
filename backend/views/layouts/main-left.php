<?php

use yii\helpers\Url;
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">     
            <li class="treeview">               
                <a href="#">                    
                    <i class="fa fa-gears"></i> <span>权限控制</span>                    
                    <i class="fa fa-angle-left pull-right"></i>               
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to(['rbac/route/index']) ?>"><i class="fa fa-circle-o"></i> 路由</a></li>
                    <li><a href="<?= Url::to(['rbac/permission/index']) ?>"><i class="fa fa-circle-o"></i> 权限</a></li>
                    <li><a href="<?= Url::to(['rbac/role/index']) ?>"><i class="fa fa-circle-o"></i> 角色</a></li>
                    <li><a href="<?= Url::to(['rbac/assignment/index']) ?>"><i class="fa fa-circle-o"></i> 分配</a></li>
                    <li><a href="<?= Url::to(['rbac/menu/index']) ?>"><i class="fa fa-circle-o"></i> 菜单</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">                    
                    <i class="fa fa-gears"></i> <span>用户管理</span>                    
                    <i class="fa fa-angle-left pull-right"></i>               
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to(['user/admin/index']) ?>"><i class="fa fa-circle-o"></i> 系统用户</a></li>
                    <li><a href="<?= Url::to(['user/user/index']) ?>"><i class="fa fa-circle-o"></i> 注册用户</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>