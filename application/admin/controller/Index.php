<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome() {
        return "hello api-admin";
    }
}
