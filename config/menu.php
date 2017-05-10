<?php

return [
    'dashboard' => [
        'id' => 'dashboard',
        'heading' => '后台首页',
        'title' => '后台首页',
        'font_icon' => 'fa fa-home',
        'link' => '/admin',
    ],
    'setting' => [
        'id' => 'setting',
        'heading' => '系统设置',
        'title' => '权限管理',
        'font_icon' => 'fa fa-home',
    ],
    'users' => [
        'id' => 'users',
        'parent_id' => 'setting',
        'title' => '管理员',
        'font_icon' => 'fa fa-circle-o',
        'link' => 'admin/users',
    ],
    'roles' => [
        'id' => 'roles',
        'parent_id' => 'setting',
        'title' => '用户角色',
        'font_icon' => 'fa fa-circle-o',
        'link' => 'admin/roles',
    ],
    'permissions' => [
        'id' => 'permissions',
        'parent_id' => 'setting',
        'title' => '权限组',
        'font_icon' => 'fa fa-circle-o',
        'link' => 'admin/permissions',
    ]

];