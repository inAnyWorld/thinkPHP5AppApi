<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Alidayu;

class Identify extends Common {

    /**
     * post
     * 设置短信验证码
     */
    public function save() {
        if(!request()->isPost()) {
            return show(config('code.error'), '您提交的 数据不合法', [], 403 );
        }

        // 检验数据
        $validate = validate('Identify');
        if(!$validate->check(input('post.'))) {
            return show(config('code.error'), $validate->getError(), [], 403);
        }

        $id = input('param.id');

        if(Alidayu::getInstance()->setSmsIdentify($id)) {
            return show(config('code.success'), 'OK', [], 201);
        }else {
            return show(config('code.error'), "error", [], 403);
        }
    }

}