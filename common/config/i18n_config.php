<?php

return [
    'translations' => [
        '*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@common/messages',
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                'app' => 'app.php',
                'app/admin' => 'admin.php',
                'app/index' => 'pages/index.php',
            ],
        ],
    ],
];
