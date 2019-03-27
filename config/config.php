<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */

define('ENABLE_HTTP_PROXY', false);//声明 阿里云sdk不使用代理

return new \Phalcon\Config([
    'sms' => [//短信验证码
        'aliyun' => [//阿里云,多个账号
            [
                'accessKeyId' => 'xgfgx',//阿里云短信服务的key
                'accessKeySecret' => 'xvxv',//密码
                'signNames' => ['xvxcv', 'xvxv', 'xvxv', 'xvxv', 'xvxv'],//该账号拥有的签名|应用
                'tempIds' => [//该账号下的模板id列表
                    'tmpid_test' => 'SMS_76005030',//短信模板id 测试
                    'tmpid_register' => 'SMS_76005027',//短信模板id 注册
                    'tmpid_login' => 'SMS_76005029',//短信模板id 登录
                    'tmpid_common' => 'SMS_75915128',//短信模板id 一般验证码
                    'tmpid_auth' => 'SMS_76005031',// 短信模板id 身份验证
                    'tmpid_edit_password' => 'SMS_76005025',//短信模板id 修改密码
                    'tmpid_find_password' => 'SMS_100910102',//短信模板id 找回密码
                    'tmpid_info_change' => 'SMS_76005024',//短信模板id 信息变更
                    'tmpid_auth_realname_f' => 'SMS_102670002',///短信模板id 实名认证失败
                    'tmpid_auth_realname_s' => 'SMS_102675002',//短信模板id 实名认证成功
                    'tmpid_withdraw_s' => 'SMS_105650013',//短信模板id 出金成功
                    'tmpid_deposit_s' => 'SMS_105365055',//短信模板id 出金成功
                    'tmpid_register_s' => 'SMS_105835072',//短信模板id 注册成功
                    'tmpid_withdraw_apply' => '',//短信模板id 出金申请成功
                    'tmpid_spread_register_s' => '',//短信模板id 注册成功（推广）
                ]
            ],
            [
                'accessKeyId' => 'xvxv',//阿里云短信服务的key
                'accessKeySecret' => 'xvxv',//密码
                'signNames' => ['xvx','xvxcv', 'xvxv', 'xvx', 'xvxv', 'xvxcvcx'],//该账号拥有的签名|应用
                'tempIds' => [//该账号下的模板id列表
                    'tmpid_test' => 'SMS_102135073',//短信模板id 测试
                    'tmpid_register' => 'SMS_102135070',//短信模板id 注册
                    'tmpid_login' => 'SMS_102135072',//短信模板id 登录
                    'tmpid_common' => 'SMS_105845111',//短信模板id 一般验证码
                    'tmpid_auth' => 'SMS_102135074',// 短信模板id 身份验证
                    'tmpid_edit_password' => 'SMS_102135069',//短信模板id 修改密码
                    'tmpid_find_password' => 'SMS_105955099',//短信模板id 找回密码
                    'tmpid_info_change' => 'SMS_102135068',//短信模板id 信息变更
                    'tmpid_auth_realname_f' => '',///短信模板id 实名认证失败
                    'tmpid_auth_realname_s' => '',//短信模板id 实名认证成功
                    'tmpid_withdraw_s' => 'SMS_105760134',//短信模板id 出金成功
                    'tmpid_deposit_s' => 'SMS_105760135',//短信模板id 入金成功
                    'tmpid_register_s' => 'SMS_105745128',//短信模板id 注册成功
                    'tmpid_withdraw_apply' => '',//短信模板id 出金申请成功
                    'tmpid_spread_register_s' => '',//短信模板id 注册成功（推广）
                ]
            ],
            [
                'accessKeyId' => 'xvxcv',//阿里云短信服务的key
                'accessKeySecret' => 'xvxcvc',//密码
                'signNames' => ['xvxc'],//该账号拥有的签名|应用
                'tempIds' => [//该账号下的模板id列表
                    'tmpid_test' => '',//短信模板id 测试
                    'tmpid_register' => '',//短信模板id 注册
                    'tmpid_login' => '',//短信模板id 登录
                    'tmpid_common' => 'SMS_115750396',//短信模板id 一般验证码
                    'tmpid_auth' => '',// 短信模板id 身份验证
                    'tmpid_edit_password' => '',//短信模板id 修改密码
                    'tmpid_find_password' => 'SMS_115750397',//短信模板id 找回密码
                    'tmpid_info_change' => '',//短信模板id 信息变更
                    'tmpid_auth_realname_f' => 'SMS_115925346',///短信模板id 实名认证失败
                    'tmpid_auth_realname_s' => 'SMS_115950422',//短信模板id 实名认证成功
                    'tmpid_withdraw_s' => 'SMS_115755400',//短信模板id 出金成功
                    'tmpid_deposit_s' => 'SMS_115755453',//短信模板id 入金成功
                    'tmpid_register_s' => 'SMS_115765468',//短信模板id 注册成功
                    'tmpid_withdraw_apply' => '',//短信模板id 出金申请成功
                    'tmpid_spread_register_s' => '',//短信模板id 注册成功（推广）
                ]
            ]
        ],
        'qqsms' => [//腾讯
            [
                'accessKeyId' => 'xvxcv',//短信服务的key
                'accessKeySecret' => 'xcvcxv',//密码
                'signNames' => ['xcvxcv','xcvcx','xvcx', 'xcvxcv', 'xcvcxv','xvxcv','xvxcv','xvcxv'],//该账号拥有的签名|应用
                'tempIds' => [//该签名下的模板id列表
                    'tmpid_test' => '56574',//短信模板id 测试
                    'tmpid_register' => '56575',//短信模板id 注册
                    'tmpid_login' => '56577',//短信模板id 登录
                    'tmpid_common' => '56591',//短信模板id 一般验证码
                    'tmpid_auth' => '56576',// 短信模板id 身份验证
                    'tmpid_edit_password' => '56580',//短信模板id 修改密码
                    'tmpid_find_password' => '56590',//短信模板id 找回密码
                    'tmpid_info_change' => '56581',//短信模板id 信息变更
                    'tmpid_auth_realname_f' => '56588',///短信模板id 实名认证失败
                    'tmpid_auth_realname_s' => '56589',//短信模板id 实名认证成功
                    'tmpid_withdraw_s' => '56583',//短信模板id 出金成功
                    'tmpid_deposit_s' => '56586',//短信模板id 出金成功
                    'tmpid_register_s' => '56582',//短信模板id 注册成功
                    'tmpid_withdraw_apply' => '97555',//短信模板id 出金申请成功
                    'tmpid_spread_register_s' => '104958',//短信模板id 注册成功（推广）
                ]
            ],
            [
                'accessKeyId' => 'xcvxc',//短信服务的key
                'accessKeySecret' => 'xvxcvc',//密码
                'signNames' => ['xcvxcv'],//该账号拥有的签名|应用
                'tempIds' => [//该签名下的模板id列表
                    'tmpid_test' => '56574',//短信模板id 测试
                    'tmpid_register' => '70737',//短信模板id 注册
                    'tmpid_login' => '56577',//短信模板id 登录
                    'tmpid_common' => '70488',//短信模板id 一般验证码
                    'tmpid_auth' => '56576',// 短信模板id 身份验证
                    'tmpid_edit_password' => '70518',//短信模板id 修改密码
                    'tmpid_find_password' => '70489',//短信模板id 找回密码
                    'tmpid_info_change' => '56581',//短信模板id 信息变更
                    'tmpid_auth_realname_f' => '70492',///短信模板id 实名认证失败
                    'tmpid_auth_realname_s' => '70491',//短信模板id 实名认证成功
                    'tmpid_withdraw_s' => '70505',//短信模板id 出金成功
                    'tmpid_deposit_s' => '70504',//短信模板id 出金成功
                    'tmpid_register_s' => '70506',//短信模板id 注册成功
                    'tmpid_withdraw_apply' => '',//短信模板id 出金申请成功
                    'tmpid_spread_register_s' => '',//短信模板id 注册成功（推广）
                ]
            ]

        ]
    ],
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'test',
        'charset' => 'utf8',
    ],
    'acl' => [//访问控制列表
        'api' => [//api模块
            'hostnames' => [//可访问的主 机列表
                '47.52.164.149',
                '47.91.245.238',
                '47.90.100.23',
                '47.89.52.57',
                '47.52.169.175',
                '47.52.253.201',
                '120.24.179.179',
                '139.224.55.113',
                '39.106.72.110',
                '127.0.0.1',
                '47.91.253.249',
                '220.112.232.3',
                '220.112.230.35',
                '220.152.205.212',
                '27.106.129.63',
                '220.112.232.9',
                '220.112.230.36',
            ]
        ]
    ],
    'application' => [
        'appDir' => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir' => APP_PATH . '/models/',
        'migrationsDir' => APP_PATH . '/migrations/',
        'viewsDir' => APP_PATH . '/views/',
        'pluginsDir' => APP_PATH . '/plugins/',
        'libraryDir' => APP_PATH . '/library/',
        'cacheDir' => ROOT_PATH . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ]
]);
