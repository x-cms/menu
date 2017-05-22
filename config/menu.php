<?php

return [
    'dashboard' => [
        'heading' => '后台首页',
        'title' => '后台首页',
        'icon' => 'fa fa-home',
        'link' => '/admin',
    ],
    'pages' => [
        'heading' => '内容管理',
        'title' => '页面管理',
        'icon' => 'fa fa-copy',
        'link' => '/admin/pages'
    ],
    'posts' => [
        'title' => '文章管理',
        'icon' => 'fa fa-edit',
        'link' => '/admin/posts'
    ],
    'categories' => [
        'title' => '分类管理',
        'icon' => 'fa fa-sitemap',
        'link' => '/admin/categories'
    ],
    'tags' => [
        'title' => '标签管理',
        'icon' => 'fa fa-tags',
        'link' => '/admin/tags'
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
                'title' => '角色组',
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