<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\Upload;

class Image extends AuthBase {

    public function save() {
        $image = Upload::image();
        if($image) {
           return show(config('code.success'), 'ok', config('qiniu.image_url').'/'.$image);
        }
    }
}