<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\IAuth;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\Alidayu;
use app\common\model\User;

class Login extends Common {

    public function save() {
        if(!request()->isPost()) {
            return show(config('code.error'), '您没有权限', '', 403);
        }

        $param = input('param.');
        if(empty($param['phone'])) {
            return show(config('code.error'), '手机不合法', '', 404);
        }
        if(empty($param['code']) && empty($param['password'])) {
            return show(config('code.error'), '手机短信验证码或者密码不合法', '', 404);
        }

        if(!empty($param['code'])) {
            $code = Alidayu::getInstance()->checkSmsIdentify($param['phone']);
            if ($code != $param['code']) {
                return show(config('code.error'), '手机短信验证码不存在', '', 404);
            }
        }

        $token = IAuth::setAppLoginToken($param['phone']);
        $data = [
            'token' => $token,
            'time_out' => strtotime("+".config('app.login_time_out_day')." days"),
        ];

        // 查询这个手机号是否存在
        $user = User::get(['phone' => $param['phone']]);
        if($user && $user->status == 1) {
            if(!empty($param['password'])) {
                // 判定用户的密码 和 $param['password'] 加密之后
                if(IAuth::setPassword($param['password']) != $user->password) {
                    return show(config('code.error'), '密码不正确', [], 403);
                }
            }
            $id = model('User')->save($data, ['phone' => $param['phone']]);
        } else {
            if(!empty($param['code'])) {
                // 第一次登录 注册数据
                $data['username'] = 'singwa粉-' . $param['phone'];
                $data['status'] = 1;
                $data['phone'] = $param['phone'];
                $id = model('User')->add($data);
            } else {
                return show(config('code.error'), '用户不存在', [], 403);
            }
        }

        $obj = new Aes();
        if($id) {
            $result = [
                'token' => $obj->encrypt($token."||".$id),
            ];
            return show(config('code.success'), 'ok', $result);
        }else {
            return show(config('code.error'), '登录失败', [], 403);
        }
    }

}