<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],

        'db' => [
            'class'    => \yii\db\Connection::class,
            'dsn'      => sprintf('mysql:host=%s;dbname=%s', getenv('MYSQL_HOST'), getenv('MYSQL_DATABASE')),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_USER'),
            'charset'  => 'utf8',
        ],

        'queue' => [
            'class' => \yii\queue\amqp_interop\Queue::class,
            'dsn' => sprintf('amqp://%s:%s@%s:%s/%%2F', getenv('RABBITMQ_USER'), getenv('RABBITMQ_PASSWORD'), getenv('RABBITMQ_HOST'), getenv('RABBITMQ_PORT')),
        ],
    ],
];
