<?php
namespace app\common\validate;

use think\Validate;
class Identify extends Validate {

    protected $rule = [
        'id' => 'require|number|length:11',
    ];
}