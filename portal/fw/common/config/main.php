<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=aricano-api',
            'username' => 'root',
            'password' => 'qweasdzxc',
            'charset' => 'utf8',
        ],
    ],
    'aliases' => [
        '@public' => Yii::$app->request->hostInfo,
        '@admin' =>  Yii::$app->request->hostInfo.'/admin',
        '@storage' => realpath(dirname(__FILE__).'/../../../storage/'),
        '@storage_base' => '/storage/',
        '@doc_root' => $_SERVER['DOCUMENT_ROOT']
    ]
];
