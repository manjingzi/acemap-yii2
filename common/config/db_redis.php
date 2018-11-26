<?php

return [
    'class' => 'yii\redis\Connection',
    'hostname' => '127.0.0.1', //你的redis地址,windows建议使用127.0.0.1,否则会巨慢
    'port' => 6379,
    'database' => 0, //默认有16个库0-15，如果是集群的话，只有一个0。
];
