<?php

namespace console\controllers;

use common\services\AddUrlToQueueService;
use frontend\models\Url;
use yii\helpers\BaseConsole;

class CheckUrlController extends \yii\console\Controller
{

    /**
     * @return void
     */
    public function actionLoadToQueue()
    {
        $this->stdout("Loading urls to queue...\n", BaseConsole::FG_YELLOW);

        /** @var Url[] $urls */
        $urls = Url::find()->all();
        foreach ($urls as $url) {
            AddUrlToQueueService::addUrlToQueue($url);
            $this->stdout("Loaded: " . $url->url . "\n", BaseConsole::FG_YELLOW);
        }

        $this->stdout("Urls loaded to queue\n", BaseConsole::FG_GREEN);
    }
}