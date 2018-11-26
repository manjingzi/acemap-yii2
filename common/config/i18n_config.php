<?php

return [
    'translations' => [
        'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@common/messages',
            'fileMap' => [
                'app' => 'app.php',
                'app/app/admin' => 'admin.php',
                'app/app/site' => 'site.php',
            ],
        ],
    ],
];
