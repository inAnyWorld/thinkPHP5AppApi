<?php
namespace app\admin\controller;

use app\common\validate\AdminUser;
use think\Controller;
use app\common\lib\IAuth;

class Login extends Base
{

    public function _initialize() {
    }
    public function index()
    {
        $isLogin = $this->isLogin();
        if($isLogin) {
            return $this->redirect('index/index');
        }else {
            // 如果后台用户已经登录了， 那么我们需要跳到后台页面
            return $this->fetch();
        }
    }

    /**
     * 登录相关业务
     */
    public function check() {
        if(request()->isPost()) {
            $data = input('post.');
            if (!captcha_check($data['code'])) {
                $this->error('验证码不正确');
            }
            try {
                $user = model('AdminUser')->get(['username' => $data['username']]);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }

            if (!$user || $user->status != config('code.status_normal')) {
                $this->error('改用户不存在');
            }

            // 再对密码进行校验
            if (IAuth::setPassword($data['password']) != $user['password']) {
                $this->error('密码不正确');
            }
            // 1 更新数据库 登录时间 登录ip
            $udata = [
                'last_login_time' => time(),
                'last_login_ip' => request()->ip(),
            ];

            try {
                model('AdminUser')->save($udata, ['id' => $user->id]);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            session(config('admin.session_user'), $user, config('admin.session_user_scope'));
            $this->success('登录成功', 'index/index');

        }else {
            $this->error('请求不合法');
        }
    }

    public function welcome() {
        return "hello api-admin";
    }

    /**
     * 退出登录的逻辑
     * 1、清空session
     * 2、 跳转到登录页面
     */
    public function logout() {
        session(null, config('admin.session_user_scope'));
        // 跳转
        $this->redirect('login/index');
    }
}
