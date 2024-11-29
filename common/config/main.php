<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],

        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => sprintf('mysql:host=%s;dbname=%s', getenv('MYSQL_HOST'), getenv('MYSQL_DATABASE')),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_USER'),
            'charset' => 'utf8',
        ],
    ],
];
