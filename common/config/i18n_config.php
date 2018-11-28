<?php

return [
    'translations' => [
        'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@common/messages',
            'fileMap' => [
                'app' => 'app.php',
                'app/app/error' => 'error.php',
                'app/app/rbac' => 'rbac.php',
            ],
        ],
        'yii' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@common/messages'
        ],
    ],
];
