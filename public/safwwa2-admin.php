<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// 定义应用目录
require 'base.php';


// 绑定当前访问到index模块
define('BIND_MODULE','admin');  //就是这里，把'index'改成'admin/main'，引号里内容可按三部分划分'模块名/控制器名/方法名'，控制器名和方法名不写则默认为index，这个大家应该很清楚了
// 加载框架引导文件
\think\App::route(false);
\think\App::run()->send();