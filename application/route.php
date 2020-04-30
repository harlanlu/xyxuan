<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'alias' => '^[a-zA-Z-_]+', // 论坛栏目只能英文字母或-_
        'status' => '\w+',
        'page' => '\d+',
    ],
    '[u]' => [
        ':id' => ['index/everyone/portal', ['method' => 'get'], ['id' => '\d+']],
    ],
    'activate' => ['index/everyone/activate', ['method' => 'get']],
    'search' => ['index/index/search', ['method' => 'get']],
    '[column]' => [
        ':alias/:type/page/:page' => ['index/thread', ['method' => 'get']],
        ':alias/page/:page' => ['index/thread', ['method' => 'get']],
        ':alias/:type' => ['index/thread', ['method' => 'get']],
        ':alias' => ['index/thread', ['method' => 'get']],
    ],
    '[thread]' => [
        ':id' => ['index/thread_views', ['method' => 'get'], ['id' => '\d+']],
    ],
    'main' => 'index/main' ,
];
