<?php
namespace app\admin\controller;

use think\Controller;

class Admin extends Controller
{

    public function add() {
        // 判定是否是post提交
        if(request()->isPost()) {
            // 打印提交的数据
            $data = input('post.');
            $validate = validate('AdminUser');
            if(!$validate->check($data)) {
                $this->error($validate->getError());
            }
            $data['password'] = md5($data['password'].'_#sing_ty');
            $data['status'] = 1;
            try {
                $id = model('AdminUser')->add($data);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if($id) {
                $this->success('id='.$id.'的用户新增成功');
            }else {
                $this->error('error');
            }
        }else {
            return $this->fetch();
        }
    }
}
