<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;

class Index extends Common {

    /**
     * 获取首页接口
     * 1、头图  4-6
     * 2、推荐位列表 默认40条
     */
    public function index() {
        $heads = model('News')->getIndexHeadNormalNews();
        $heads = $this->getDealNews($heads);

        $positions = model('News')->getPositionNormalNews();
        $positions = $this->getDealNews($positions);

        $result = [
            'heads' => $heads,
            'positions' => $positions,
        ];


        return show(config('code.success'), 'OK', $result, 200);
    }

    /**
     * 客户端初始化接口
     * 1、检测APP是否需要升级
     */
    public function init() {
        // app_type 去ent_version 查询
        $version = model('Version')->getLastNormalVersionByAppType($this->headers['app_type']);

        if(empty($version)) {
            return new ApiException('error', 404);
        }

        if($version->version > $this->headers['version']) {
            $version->is_update = $version->is_force == 1 ? 2 : 1;
        }else {
            $version->is_update = 0;  // 0 不更新 ， 1需要更新, 2强制更新
        }

        // 记录用户的基本信息 用于统计
        $actives = [
            'version' => $this->headers['version'],
            'app_type' => $this->headers['app_type'],
            'did' => $this->headers['did'],
        ];
        try {
            model('AppActive')->add($actives);
        }catch (\Exception $e) {
            
        }

        return show(config('code.success'), 'OK', $version, 200);
    }

}