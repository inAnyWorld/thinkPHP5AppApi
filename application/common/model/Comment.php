<?php
namespace app\common\model;
use think\Model;
use app\common\model\Base;
use think\Db;

class Comment extends Base {

    /**
     * 通过条件获取评论的数量
     * @param array $param
     */
    public function getNormalCommentsCountByCondition($param = []) {
        // status =  1 小伙伴自行完成
        $count = Db::table('ent_comment')
            ->alias(['ent_comment' => 'a', 'ent_user' => 'b'])
            ->join('ent_user', 'a.user_id = b.id AND a.news_id = ' . $param['news_id'])
            ->count();
        return $count;
    }

    /**
     * 通过条件获取列表数据
     * @param array $param
     * @param int $from
     * @param int $size
     * @return array
     */
    public function getNormalCommnetsByCondition($param = [], $from=0, $size = 5) {
        $result = Db::table('ent_comment')
            ->alias(['ent_comment' => 'a', 'ent_user' => 'b'])
            ->join('ent_user', 'a.user_id = b.id AND a.news_id = ' . $param['news_id'])
            ->limit($from, $size)
            ->order(['a.id' => 'desc'])
            ->select();
        return $result;
    }

    /**
     *
     */
    public function getCountByCondition($param = []) {
        return $this->where($param)
            ->field('id')
            ->count();
    }

    /**
     * @param array $param
     * @param int $from
     * @param int $size
     */
    public function getListsByCondition($param = [], $from=0, $size = 5) {
        return $this->where($param)
            ->field('*')
            ->limit($from, $size)
            ->order(['id' => 'desc'])
            ->select();
    }
}