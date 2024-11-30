<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    (file_exists(__DIR__ . '/../../common/config/params-local.php') ? require(__DIR__ . '/../../common/config/params-local.php') : []),
    require __DIR__ . '/params.php',
    (file_exists(__DIR__ . '/params-local.php') ? require(__DIR__ . '/params-local.php') : []),
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'queue',],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'flushInterval' => 1,
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                    'exportInterval' => 1,
                ],
            ],
        ],

        'client' => [
            'class'         => \yii\httpclient\Client::class,
            'transport'     => \yii\httpclient\CurlTransport::class,
            'requestConfig' => [
                'options' => [
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_SSL_VERIFYHOST => 0,
                ],
            ],
        ],
    ],
    'params' => $params,
];
