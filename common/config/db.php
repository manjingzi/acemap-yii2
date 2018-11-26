<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=yii2',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'tablePrefix' => 'jj_',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 24 * 3600,
    'schemaCache' => 'cache',
];
