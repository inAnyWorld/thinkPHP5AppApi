<?php
namespace app\api\controller;

use app\common\lib\IAuth;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use ali\top\TopClient;
use ali\top\request\AlibabaAliqinFcSmsNumSendRequest;
use app\common\lib\Alidayu;

class Test extends Controller {

    public function index() {
        return [
            'sgsg',
            'sgsgs',
        ];
    }

    public function update($id = 0) {
        halt(input('put.'));
    }

    /**
     * post 新增
     * @return mixed
     */
    public function save() {
        $data = input('post.');

        // 获取到提交数据 插入库，
        // 给客户端APP  =》 接口数据
        return show(1, 'OK', (new Aes())->encrypt(json_encode(input('post.'))), 201);
    }

    /**
     * 发送短信测试场景
     */
    public function sendSms() {
        $c = new TopClient;
        $c->appkey = "24528979";
        $c->secretKey = "ec6d90dc7e93b4cc824183f71710e1ee";
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("singwa娱乐app");
        $req->setSmsParam("{\"number\":\"4567\"}");
        $req->setRecNum("18618158941");
        $req->setSmsTemplateCode("SMS_75915048");
        $resp = $c->execute($req);
        halt($resp);
    }

    public function testsend() {
        Alidayu::getInstance()->setSmsIdentify('18618158941');
    }
    public function token() {
        echo IAuth::setAppLoginToken();
    }

}