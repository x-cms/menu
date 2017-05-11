<?php

return [
    'dashboard' => [
        'heading' => '后台首页',
        'title' => '后台首页',
        'icon' => 'fa fa-home',
        'link' => '/admin',
    ],
    'setting' => [
        'heading' => '系统设置',
        'title' => '权限管理',
        'icon' => 'fa fa-home',
        'children' => [
            'users' => [
                'title' => '管理员',
                'icon' => 'fa fa-circle-o',
                'link' => '/admin/users',
            ],
            'roles' => [
                'title' => '用户角色',
                'icon' => 'fa fa-circle-o',
                'link' => '/admin/roles',
            ],
            'permissions' => [
                'title' => '权限组',
                'icon' => 'fa fa-circle-o',
                'link' => '/admin/permissions',
            ]
        ]
    ]
];