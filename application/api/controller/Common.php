<?php
namespace app\api\controller;

use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\IAuth;
use app\common\lib\Time;
use think\Cache;

/**
 * API模块 公共的控制器
 * Class Common
 * @package app\api\controller
 */
class Common extends Controller {

    /**
     * headers信息
     * @var string
     */
    public $headers = '';

    public $page = 1;
    public $size = 10;
    public $from = 0;

    /**
     * 初始化的方法
     */
    public function _initialize() {
        $this->checkRequestAuth();
        //$this->testAes();
    }

    /**
     * 检查每次app请求的数据是否合法
     */
    public function checkRequestAuth() {
        // 首先需要获取headers
        $headers = request()->header();
        // todo

        // sign 加密需要 客户端工程师 ， 解密：服务端工程师
        // 1 headers body 仿照sign 做参数的加解密
        // 2
        // 3
        // 基础参数校验
        if(empty($headers['sign'])) {
            throw new ApiException('sign不存在', 400);
        }
        if(!in_array($headers['app_type'], config('app.apptypes'))) {
            throw new ApiException('app_type不合法', 400);
        }

        // 需要sign
        if(!IAuth::checkSignPass($headers)) {
            throw new ApiException('授权码sign失败', 401);
        }
        Cache::set($headers['sign'], 1, config('app.app_sign_cache_time'));

        // 1、文件  2、mysql 3、redis
        $this->headers = $headers;
    }

    public function testAes() {
        $data = [
            'did' => '12345dg',
            'version' => 1,
            'time' => Time::get13TimeStamp(),
        ];

        //$str = 'sRCvj52mZ8G+u2OdHYwmysvczmCw+RrAYWiEaXFI/5A=';
        // col9j6cqegAKiiey3IrXWo2zCRGHw8vogniwQZab0fgIVnKDb7Rin03dOqY2qLWP
        echo IAuth::setSign($data);exit;
        echo (new Aes())->decrypt($str);exit;
    }

    /**
     * 获取处理的新闻的内容数据
     * @param array $news
     * @return array
     */
    protected  function getDealNews($news = []) {
        if(empty($news)) {
            return [];
        }

        $cats = config('cat.lists');

        foreach($news as $key => $new) {
            $news[$key]['catname'] = $cats[$new['catid']] ? $cats[$new['catid']] : '-';
        }

        return $news;
    }

    /**
     * 获取分页page size 内容
     */
    public function getPageAndSize($data) {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }


}