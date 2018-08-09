<?php
/**
 * 客户端服务端加密解密 
 */
return [
    'password_pre_halt' => '_#sing_ty',// 密码加密盐
    'aeskey' => 'sgg45747ss223455',//aes 密钥 , 服务端和客户端必须保持一致
    'apptypes' => [
        'ios',
        'android',
    ],
    'app_sign_time' => 10,// sign失效时间
    'app_sign_cache_time' => 20,// sign 缓存失效时间
    'login_time_out_day' => 7,// 登录token的失效时间
];