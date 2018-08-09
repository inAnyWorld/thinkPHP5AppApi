<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;

class News extends Common {

    public function index() {
        $data = input('get.');

        $whereData['status'] = config('code.status_normal');
        if(!empty($data['catid'])) {
            $whereData['catid'] = input('get.catid', 0, 'intval');
        }
        if(!empty($data['title'])) {
            $whereData['title'] = ['like', '%'.$data['title'].'%'];
        }

        $this->getPageAndSize($data);
        $total = model('News')->getNewsCountByCondition($whereData);
        $news = model('News')->getNewsByCondition($whereData, $this->from, $this->size);

        $result = [
            'total' => $total,
            'page_num' => ceil($total / $this->size),
            'list' => $this->getDealNews($news),
        ];

        return show(config('code.success'), 'OK', $result, 200);
    }

    /**
     * 获取详情接口
     */
    public function read() {
        $id = input('param.id', 0, 'intval');
        if(empty($id)) {
            return new ApiException('id is not ', 404);
        }
        $news = model('News')->get($id);
        if(empty($news) || $news->status != config('code.status_normal')) {
            return new ApiException('不存在该新闻', 404);
        }

        try {
            model('News')->where(['id' => $id])->setInc('read_count');
        }catch(\Exception $e) {
            return new ApiException('error', 400);
        }

        $cats = config('cat.lists');
        $news->catname = $cats[$news->catid];
        return show(config('code.success'), 'OK', $news, 200);
    }

}