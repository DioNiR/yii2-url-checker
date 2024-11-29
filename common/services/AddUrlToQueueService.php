<?php

use common\jobs\CheckUrlJob;

class AddUrlToQueueService
{
    protected \models\Url $url;

    public function __construct(\models\Url $url)
    {
        $this->url = $url;
    }

    public function execute(): void
    {
        Yii::$app->queue->push(new CheckUrlJob(
            [
                'url'                  => $this->url->url,
                'testFrequencyMinutes' => $this->url->test_frequency_minutes,
                'attempts'             => $this->url->test_error_repeats,
                'delay'                => $this->url->delay_minutes * 1000
            ]
        ));
    }
}