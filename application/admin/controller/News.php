<?php
namespace app\admin\controller;

use think\Controller;

class News extends Base
{
    public function index() {
        $data = input('param.');
        $query = http_build_query($data);
        //halt($data);

        $whereData = [];
        // 转换查询条件
        if(!empty($data['start_time']) && !empty($data['end_time'])
            && $data['end_time'] > $data['start_time']
        ) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if(!empty($data['catid'])) {
            $whereData['catid'] = intval($data['catid']);
        }
        if(!empty($data['title'])) {
            $whereData['title'] = ['like', '%'.$data['title'].'%'];
        }
        $this->getPageAndSize($data);

        // 获取表里面的数据
        $news = model('News')->getNewsByCondition($whereData, $this->from, $this->size);
        // 获取满足条件的数据总数 =》 有多少页
        $total = model('News')->getNewsCountByCondition($whereData);
        /// 结合总数+size  =》 有多少页
        $pageTotal = ceil($total/$this->size);//1.1 =>2

        return $this->fetch('', [
            'cats' => config('cat.lists'),
            'news' => $news,
            'pageTotal' => $pageTotal,
            'curr' => $this->page,
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'catid' => empty($data['catid']) ? '' : $data['catid'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'query' => $query,
        ]);
    }

    public function add() {

        if(request()->isPost()) {

            $data = input('post.');
            try {
                $id = model('News')->add($data);
            }catch (\Exception $e) {
                return $this->result('', 0, '新增失败');
            }

            if($id) {
                return $this->result(['jump_url' => url('news/index')], 1, 'OK');
            } else {
                return $this->result('', 0, '新增失败');
            }
        }else {
            return $this->fetch('', [
                'cats' => config('cat.lists')
            ]);
        }
    }
}
