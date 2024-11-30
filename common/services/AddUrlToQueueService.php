<?php

namespace common\services;

use common\jobs\CheckUrlJob;
use frontend\models\Url;
use Yii;

class AddUrlToQueueService
{
    protected Url $url;

    /**
     * @param $url
     * @return string|null
     */
    public static function addUrlToQueue($url): ?string
    {
        $service = new self($url);
        return $service->add();
    }

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function execute(): ?string
    {
        return $this->add();
    }

    private function add(): ?string
    {
       return Yii::$app->queue->push(new CheckUrlJob(
            [
                'urlId'    => $this->url->id,
                'url'      => $this->url->url,
                'delay'    => $this->url->test_frequency_minutes * 60,
                'attempts' => 0,
                'tryDelay' => $this->url->delay_minutes * 60,
                'maxTries' => $this->url->test_error_repeats
            ]
        ));
    }
}