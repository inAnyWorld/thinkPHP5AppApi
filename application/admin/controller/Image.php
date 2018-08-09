<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\lib\Upload;

/**
 * 后台图片上传相关逻辑
 * Class Image
 * @package app\admin\controller
 */
class Image extends Base
{
    /**
     * 图片上传
     */
    public function upload0() {

        $file = Request::instance()->file('file');
        // 把图片上传到指定的文件夹中
        $info = $file->move('upload');

        if($info && $info->getPathname()) {
            $data = [
                'status' => 1,
                'message' => 'OK',
                'data' => '/'.$info->getPathname(),
            ];
            echo json_encode($data);exit;
        }

        echo json_encode(['status' => 0, 'message' => '上传失败']);

    }

    /**
     * 七牛图片上传
     *
     * http://otwueljs0.bkt.clouddn.com/2017/07/30d35201707310115086587.jpg
     * http://otwueljs0.bkt.clouddn.com/2017/07/30d35201707310115086587.jpg
     */
    public function upload() {
        try {
            $image = Upload::image();
        }catch (\Exception $e) {
            echo json_encode(['status' => 0, 'message' => $e->getMessage()]);
        }
        if($image) {
            $data = [
                'status' => 1,
                'message' => 'OK',
                'data' => config('qiniu.image_url').'/'.$image,
            ];
            echo json_encode($data);exit;
        }else {
            echo json_encode(['status' => 0, 'message' => '上传失败']);
        }
    }
}
