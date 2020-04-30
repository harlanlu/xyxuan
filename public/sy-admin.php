<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// 定义项目路径
define('APP_PATH', __DIR__ . '/../application/');
require 'base.php';

\think\Route::bind('admin');

\think\App::route(false);
\think\App::run()->send();
