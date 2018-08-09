<?php
namespace app\admin\controller;

use think\Controller;

/**
 * 后台基础类库
 * Class Base
 * @package app\admin\controller
 */
class Base extends Controller
{
    /**
     * page
     * @var string
     */
    public $page = '';

    /**
     * 每页显示多少条
     * @var string
     */
    public $size = '';
    /**
     * 查询条件的起始值
     * @var int
     */
    public $from = 0;

    /**
     * 定义model
     * @var string
     */
    public $model = '';

    /**
     * 初始化的方法
     */
    public function _initialize() {
        // 判定用户是否登录
        $isLogin = $this->isLogin();
        if(!$isLogin) {
            return $this->redirect('login/index');
        }

    }

    /**
     * 判定是否登录
     * @return bool
     */
    public function isLogin() {
        //获取session
        $user = session(config('admin.session_user'), '', config('admin.session_user_scope'));
        if($user && $user->id) {
            return true;
        }

        return false;
    }

    /**
     * 获取分页page size 内容
     */
    public function getPageAndSize($data) {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }

    /**
     * 删除逻辑
     */
    public function delete($id = 0) {
        if(!intval($id)) {
            return $this->result('', 0, 'ID不合法');
        }

        // 通过id 去库中查询下记录是否存在

        // 如果你的表和我们控制器文件名 一样。 news news
        // 但是我们 不一样。

        $model = $this->model ? $this->model : request()->controller();
        // 如果php php7  $model = $this->model ?? request()->controller();

        try {
            $res = model($model)->save(['status' => -1], ['id' => $id]);
        }catch(\Exception $e) {
            return $this->result('', 0, $e->getMessage());
        }

        if($res) {
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'OK');
        }
        return $this->result('', 0, '删除失败');

    }

    /**
     * 通用化修改状态
     */
    public function status() {
        $data  = input('param.');
        $model = $this->model ? $this->model : request()->controller();

        try {
            $res = model($model)->save(['status' => $data['status']], ['id' => $data['id']]);
        }catch(\Exception $e) {
            return $this->result('', 0, $e->getMessage());
        }

        if($res) {
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'OK');
        }
        return $this->result('', 0, '修改失败');
    }
}
