<?php

namespace console\controllers;

use common\services\AddUrlToQueueService;
use frontend\models\Url;

class CheckUrlController extends \yii\console\Controller
{
    /**
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        $urlName = 'https://google.com';

        $url = new Url();
        $url->url = $urlName;
        $url->test_frequency_minutes = 1;
        $url->test_error_repeats = 10;
        $url->delay_minutes = 0;
        $url->save();

        $addUrlToQueueService = new AddUrlToQueueService($url);
        $id = $addUrlToQueueService->execute();

        var_dump($id);
    }

    /**
     * @throws \yii\httpclient\Exception
     */
    public function actionTestClient()
    {
        $urlName = 'https://google.com';
        $client = \Yii::$app->client;
        $response = $client->get($urlName)->send();

        var_dump($response->getStatusCode());
    }
}