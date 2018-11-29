<?php

$params = require(__DIR__ . '/params.php');

$config = $params['email_send'];

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'timeZone' => 'PRC',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //'defaultRoles' => ['guest'],
        ],
        'i18n' => require(__DIR__ . '/i18n_config.php'),
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false, //这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $config['smtp_server'], //每种邮箱的host配置不一样
                'username' => $config['smtp_user_mail'], //你的邮箱
                'password' => $config['smtp_pass'], //你的密码
                'port' => $config['smtp_server_port'],
                'encryption' => 'ssl', //加密方式
            ],
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => [
                    $config['smtp_user_mail'] => $config['smtp_user']
                ]
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => ['_GET', '_POST', '_SESSION'],
                    'logFile' => '@runtime/logs/' . date('Ymd') . '.log',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'redis' => require(__DIR__ . '/db_redis.php'),
        'cache' => ['class' => 'yii\redis\Cache'],
    ],
];
