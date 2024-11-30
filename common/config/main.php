<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['log', 'queue',],
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
            'host' => getenv('RABBITMQ_HOST'),
            'port' => '5672',
            'user' => getenv('RABBITMQ_USER'),
            'password' => getenv('RABBITMQ_PASSWORD'),
            'queueName' => 'queue',
            'driver' => yii\queue\amqp_interop\Queue::ENQUEUE_AMQP_LIB,
        ],
    ],
];
