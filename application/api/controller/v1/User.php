<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\IAuth;

class User extends AuthBase {

    /**
     * 获取用户信息
     * 用户的基本信息非常隐私、需要加密处理
     */
    public function read() {
        $obj = new Aes();
        return show(config('code.success'), 'ok', $obj->encrypt($this->user));
    }

    /**
     * 修改数据
     */
    public function update() {
        $postData  =  input('param.');
        // validate 进行校验 大家 自行完成
        $data = [];

        if(!empty($postData['image'])) {
            $data['image'] = $postData['image'];
        }
        if(!empty($postData['username'])) {
            $data['username'] = $postData['username'];
        }
        if(!empty($postData['sex'])) {
            $data['sex'] = $postData['sex'];
        }
        if(!empty($postData['signature'])) {
            $data['signature'] = $postData['signature'];
        }
        if(!empty($postData['password'])) {
            // 传输过程当中也是需要加密
            $data['password'] = IAuth::setPassword($postData['password']);
        }

        if(empty($data)) {
            return show(config('code.error'), '数据不合法', [], 404);
        }

        try {
            $id = model('User')->save($data, ['id' => $this->user->id]);
            if($id) {
                return show(config('code.success'), 'OK', [], 202);
            }else {
                return show(config('code.error'), '更新失败', [], 401);
            }
        }catch (\Exception $e) {
            return show(config('code.error'), $e->getMessage(), [], 500);
        }

    }
}