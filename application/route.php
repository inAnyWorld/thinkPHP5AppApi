<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//get
Route::get('test', 'api/test/index');
Route::put('test/:id', 'api/test/update');// 修改
Route::delete('test/:id', 'api/test/delete');// delete


Route::resource('test', 'api/test');
/// x.com/test  post  => api test save

Route::get('api/:ver/cat', 'api/:ver.cat/read');
Route::get('api/:ver/index', 'api/:ver.index/index');
Route::get('api/:ver/init', 'api/:ver.index/init');

// news
Route::resource('api/:ver/news', 'api/:ver.news');
//排行
Route::get('api/:ver/rank', 'api/:ver.rank/index');
//短信验证码相关
Route::resource('api/:ver/identify', 'api/:ver.identify');
// 登录的路由
Route::post('api/:ver/login', 'api/:ver.login/save');

Route::resource('api/:ver/user', 'api/:ver.user');
// 图片上传
Route::post('api/:ver/image', 'api/:ver.image/save');
//点赞
Route::post('api/:ver/upvote', 'api/:ver.upvote/save');
//点赞
Route::delete('api/:ver/upvote', 'api/:ver.upvote/delete');
Route::get('api/:ver/upvote/:id', 'api/:ver.upvote/read');
//评论
Route::post('api/:ver/comment', 'api/:ver.comment/save');
Route::get('api/:ver/comment/:id', 'api/:ver.comment/read');