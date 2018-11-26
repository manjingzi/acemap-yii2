<?php

$config = [
    'components' => [
        'request' => [
            'cookieValidationKey' => '',
        ],
    ],
];

if (YII_ENV_DEV) {
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//    ];
}

return $config;
