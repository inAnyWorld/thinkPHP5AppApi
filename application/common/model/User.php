<?php
namespace app\common\model;
use think\Model;
use app\common\model\Base;

class User extends Base {

    /**
     * @param array $userIds
     */
    public function getUsersUserId($userIds = []) {
        $data = [
            'id' => ['in', implode(',', $userIds)],// in
            'status' => 1,
        ];

        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
            ->field(['id', 'username', 'image'])
            ->order($order)
            ->select();
    }
}