<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\IAuth;

class Comment extends AuthBase {

    /**
     * 评论 - 回复功能开发
     */
    public function save() {
        $data = input('post.', [] );
        $data['user_id'] = $this->user->id;

        try {
            $commentId = model('Comment')->add($data);
            if($commentId) {
                //model('News')->where(['id' => $id])->setDec('upvote_count');
                return show(config('code.success'), 'OK', [], 202);
            }else {
                return show(config('code.error'), '评论失败', [], 500);
            }

        }catch (\Exception $e) {

        }
    }

    /**
     * v2.0
     * @return ApiException|array
     */
    public function read() {
        // select * from ent_comment as a join ent_user as b on a.user_id = b.id and a.news_id=7;
        $newsId = input('param.id', 0, 'intval');
        if(empty($newsId)) {
            return new ApiException('id is not ', 404);
        }

        $param['news_id'] = $newsId;
        $count = model('Comment')->getCountByCondition($param);

        $this->getPageAndSize(input('param.'));
        $comments = model('Comment')->getListsByCondition($param, $this->from, $this->size);

        if($comments) {
            foreach($comments as $comment) {
                $userIds[] = $comment['user_id'];
                if($comment['to_user_id']) {
                    $userIds[] = $comment['to_user_id'];
                }
            }
            $userIds = array_unique($userIds);
        }

        $userIds = model('User')->getUsersUserId($userIds);
        //halt($userIds);
        if(empty($userIds)) {
            $userIdNames = [];
        }else {
            foreach($userIds as $userId) {
                $userIdNames[$userId->id] = $userId;
            }
        }

        $resultDatas = [];
        foreach($comments as $comment)  {
            $resultDatas[] = [
                'id' => $comment->id,
                'user_id' => $comment->user_id,
                'to_user_id' => $comment->to_user_id,
                'content' => $comment->content,
                'username' => !empty($userIdNames[$comment->user_id]) ? $userIdNames[$comment->user_id]->username : '',
                'tousername' => !empty($userIdNames[$comment->to_user_id]) ? $userIdNames[$comment->to_user_id]->username : '',
                'parent_id' => $comment->parent_id,
                'create_time' => $comment->create_time,
                'image' => !empty($userIdNames[$comment->user_id]) ? $userIdNames[$comment->user_id]->image : '',
            ];
        }

        $result = [
            'total' => $count,
            'page_num' => ceil($count / $this->size),
            'list' => $resultDatas,
        ];

        return show(config('code.success'), 'OK', $result, 200);
    }
}