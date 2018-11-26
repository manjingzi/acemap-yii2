<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'session' => [
            'name' => '_session-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager',
//            'defaultRoles' => ['guest'],
//        ]
    ],
    'modules' => [
        'article' => [
            'class' => 'backend\modules\article\Module',
        ],
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'ad' => [
            'class' => 'backend\modules\ad\Module',
        ],
        'link' => [
            'class' => 'backend\modules\link\Module',
        ],
        'notity' => [
            'class' => 'backend\modules\notity\Module',
        ],
        'rbac' => [
            'class' => 'backend\modules\rbac\Module',
        ],
        'upload' => [
            'class' => 'backend\modules\upload\Module',
        ],
        'feedback' => [
            'class' => 'backend\modules\feedback\Module',
        ],
        'oauth' => [
            'class' => 'backend\modules\oauth\Module',
        ],
    ],
    'params' => $params,
];
