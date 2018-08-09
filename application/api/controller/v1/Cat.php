<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;

class Cat extends Common {

    /**
     * 栏目接口
     */
    public function read() {
        $cats = config('cat.lists');

        $result[] = [
            'catid' => 0,
            'catname' => '首页',
        ];

        foreach($cats as $catid => $catname) {
            $result[] = [
                'catid' => $catid,
                'catname' => $catname,
            ];
        }

        return show(config('code.success'), 'OK', $result, 200);
    }

}